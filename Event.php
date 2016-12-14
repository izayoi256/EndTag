<?php
/*
 * Copyright(c) 2000-2016 Daisy CO., LTD. All Rights Reserved.
 *
 * http://daisy.link/
 */

namespace Plugin\EndTag;

use Eccube\Application;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

class Event
{
    /**
     * @var Application
     */
    protected $app;

    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * @param FilterResponseEvent $event
     */
    public function onEntryResponse($event)
    {
        $app = $this->app;
        $request = $event->getRequest();
        $response = $event->getResponse();
        $html = $response->getContent();

        /** @var FormBuilderInterface $builder */
        $builder = $app['form.factory']->createBuilder('entry');

        $form = $builder->getForm();
        $form->handleRequest($request);

        /** @var \DOMDocument $dom */
        /** @var \DOMDocumentFragment $template */
        /** @var \DOMXPath $xpath */
        /** @var \DOMNode $node */
        extract($this->initDomParser($html));

        if ($form->isSubmitted() && $form->isValid() && $request->get('mode') == 'confirm') {

            $builder->setAttribute('freeze', true);
            $form = $builder->getForm();
            $form->handleRequest($request);
        }

        $elements = $xpath->query('id("top_box__body_inner")|id("confirm_box__body_inner")');
        if ($elements && $elements->item(0)) {

            $element = $elements->item(0)->nextSibling;
            $twig = $this->renderView(
                'EndTag/Resource/template/default/Entry/form.hoge.twig',
                array(
                    'form' => $form->createView(),
                )
            );
            $template->appendXml($twig);
            $element->parentNode->insertBefore($node, $element);
        }

        $response->setContent($this->encodeHtml($dom->saveHTML()));
        $event->setResponse($response);
    }


    /**
     * @param string $html
     * @return string
     */
    protected function encodeHtml($html)
    {
        return mb_convert_encoding(str_replace('&amp;', '&', $html), 'UTF-8', 'HTML-ENTITIES');
    }

    /**
     * @param string $view
     * @param array $parameters
     * @return string
     */
    protected function renderView($view, $parameters = array())
    {
        return str_replace('&', '&amp;', $this->app->renderView($view, $parameters));
    }

    /**
     * @param string $html
     * @return array [dom=>\DOMDocument, node=>\DOMNode, template=>\DOMDocumentFragment, xpath=>\DOMXPath]
     */
    protected function initDomParser($html)
    {
        libxml_use_internal_errors(true);
        $dom = new \DOMDocument();
        $dom->loadHTML(mb_convert_encoding('<!DOCTYPE html>' . $html, 'HTML-ENTITIES', 'auto'));
        $dom->encoding = 'UTF-8';
        $dom->formatOutput = true;
        $template = $dom->createDocumentFragment();
        $node = $dom->importNode($template, true);
        $xpath = new \DOMXPath($dom);
        return compact('dom', 'node', 'template', 'xpath');
    }
}
