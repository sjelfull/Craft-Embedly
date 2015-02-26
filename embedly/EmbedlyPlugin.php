<?php

namespace Craft;

class EmbedlyPlugin extends BasePlugin {

    function getName()
    {
        return Craft::t('Embed.ly');
    }

    function getVersion()
    {
        return '0.1';
    }

    function getDeveloper()
    {
        return 'sjelfull';
    }

    function getDeveloperUrl()
    {
        return 'http://sjelfull.no';
    }

    public function getSettingsHtml()
    {
        return craft()->templates->render('embedly/_settings', array(
            'settings' => $this->getSettings()
        ));
    }

    protected function defineSettings()
    {
        return array(
            'apiKey' => array(AttributeType::String, 'label' => 'Embed.ly API Key'),
        );
    }
}
