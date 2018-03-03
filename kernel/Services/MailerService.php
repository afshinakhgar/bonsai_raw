<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 3/3/18
 * Time: 4:09 PM
 */

namespace Kernel\Services;


use Kernel\Abstracts\AbstractContainer;

class MailerService extends AbstractContainer
{
    public function init()
    {
        $config = $this->settings['swiftmailer'];
        $allowedTransportTypes = $config['allowed_transport_type'];
        if (false === $config['enabled']
            || !in_array($config['transport_type'], $allowedTransportTypes)
        ) {
            return false;
        }
        if ('smtp' === $config['transport_type']) {
            $transport = new \Swift_SmtpTransport();
        } elseif ('sendmail' === $config['transport_type']) {
            $transport = new \Swift_SendmailTransport();
        }
        if (isset($config[$config['transport_type']])
            && is_array($config[$config['transport_type']])
            && count($config[$config['transport_type']])
        ) {
            foreach ($config[$config['transport_type']] as $optionKey => $optionValue) {
                $methodName = 'set' . str_replace('_', '', ucwords($optionKey, '_'));
                $transport->{$methodName}($optionValue);
            }
        }
        return new \Swift_Mailer($transport);
    }
}