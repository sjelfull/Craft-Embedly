<?php
namespace Craft;
require_once(CRAFT_PLUGINS_PATH . 'embedly/vendor/autoload.php');
use \Embedly\Embedly;

class EmbedlyService extends BaseApplicationComponent {

    protected $api;
    protected $settings;

    public function init()
    {
        // Fetch settings & parse them for environment variables
        $this->settings = craft()->plugins->getPlugin('embedly')->getSettings();
        $this->parseSettingsForEnvVariables();

        // Setup Embedly client
        $clientSettings = array('user_agent' => 'Mozilla/5.0 (compatible; mytestapp/1.0)');

        // Add API key if set
        if (isset($this->settings['apiKey'])) $clientSettings['key'] = $this->settings['apiKey'];
        $this->api = new Embedly($clientSettings);
    }

    /**
     * Add one (string) or multiple urls (array)
     * @param $url
     * @return array
     */
    public function oembed($url)
    {
        if (! isset($url) ) return;

        if (is_array($url)) {
            $response = $this->api->oembed(array('urls' => $url));
        } else {
            $response = $this->api->oembed($url);
        }

        // Put objects into arrays
        return $this->responseObjectsIntoArray($response);
    }

    /**
     * Cast response objects into arrays so that we can iterate over them with Twig
     * @param $response
     * @return array
     */
    private function responseObjectsIntoArray($response)
    {
        if (!is_array($response)) {
            return (array) $response;
        }

        $elements = array();
        foreach ($response as $key => $object) {
            $elements[] = (array) $object;
        }

        return $elements;
    }

    /**
     * Parses settings for environment variables
     */
    private function parseSettingsForEnvVariables()
    {
        if ( ! empty($this->settings))
        {
            foreach ($this->settings as $key => $value) {
                $this->settings[$key] = craft()->config->parseEnvironmentString( $value );
            }
        }
    }
}