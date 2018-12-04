<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 3/3/18
 * Time: 4:09 PM
 */

namespace Kernel\Services;


use Kernel\Abstracts\AbstractContainer;
/**
 * @property \Swift_Mailer $mailer
*/
class MailerService extends AbstractContainer
{
    public function swift()
    {
        $config = $GLOBALS['settings']['swiftmailer'];
        $allowedTransportTypes = ['smtp', 'sendmail'];
        if (false === $config['enable']
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



    public function send(string $subject = 'Wonderful Subject',$welcomeEmail,array $from = ['someoneElse@example.com' => 'You'] , array $to = ['someoneElse@example.com' => 'You'])
    {
        $welcomeEmail = $this->view->render('emails.welcome');

        // Setting all needed info and passing in my email template.
        $message = \Swift_Message::newInstance($subject)
            ->setFrom($from)
            ->setTo($to)
            ->setBody($welcomeEmail)
            ->setContentType("text/html");

        // Send the message
        $results = $this->mailer->send($message);

        // Print the results, 1 = message sent!
        print($results);

    }
}