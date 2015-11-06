<?php

namespace App\Build;
use App\Config;
/**
 * Short description for class
 *
 * Long description for class (if any)...
 *
 * @copyright  06/11/15 , 10:47 lee
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @version
 * @link
 * @since
 */
class Mailer {
    /**
    * Var info
    *
    * @var $var
    */
    private $MailConf = [], $MailUser = [], $Transport, $Mailer;
    private $Message;
    /**
     * Does something interesting
     * 06/11/15 , 10:47
     * @param  type    $name  What it does
     * @throws Exception If something interesting cannot happen
     * @return Info
     */
    public function __construct()
    {
        $this->MailConf = array2std( Config::get('mail')[ Config::get('mail')['default'] ] );
        $this->MailUser = array2std( Config::get('mail')["sender"] );

     $this->Transport = \Swift_SmtpTransport::newInstance(
         $this->MailConf->domain, $this->MailConf->port , $this->MailConf->encrypt
     )->setUsername($this->MailConf->username)->setPassword($this->MailConf->password);
     $this->Mailer = \Swift_Mailer::newInstance($this->Transport);
    }

    /**
     * Does something interesting
     * 06/11/15 , 11:12
     * @param  string    $content  Where something interesting takes place
     * @param  array  $replaceVars How many times something interesting should happen
     * @throws Exception If something interesting cannot happen
     * @return Status
     */
    public function content( $subject, $content , array $replaceVars = [] )
    {
        $this->Message = \Swift_Message::newInstance($subject);
        $this->Message->setBody( $content );
        return $this;
    }

    /**
     * Does something interesting
     * 06/11/15 , 11:18
     * @param  array    $attachments  Where something interesting takes place
     * @throws Exception If something interesting cannot happen
     * @return Status
     */
    public function attach( array $attachments )
    {
        foreach( $attachments as $attachment )
        {
            if( ! file_exists($attachment) )
            {
                // throw new Exception;
            }
            $mime = mime_content_type($attachment);
            $attach = \Swift_Attachment::fromPath( $attachment , $mime);
            $this->Message->attach($attach);
        }
        return $this;
    }

    /**
     * Does something interesting
     * 06/11/15 , 11:31
     * @param  string    $where  Where something interesting takes place
     * @param  integer  $repeat How many times something interesting should happen
     * @throws Exception If something interesting cannot happen
     * @return Status
     */
    public function to( array $sendTo )
    {
        $this->Message->setTo([
            $sendTo["email"] => $sendTo["name"]
        ]);
    }
    /**
     * Does something interesting
     * 06/11/15 , 10:53
     * @param  string    $where  Where something interesting takes place
     * @param  integer  $repeat How many times something interesting should happen
     * @throws Exception If something interesting cannot happen
     * @return Status
     */
    public function send()
    {
     $mailUser = array2std( Config::get('mail')["sender"] );
     $this->Message->setFrom(array($this->MailUser->email => $this->MailUser->name ));
     return $this->Mailer->send($this->Message);
    }

}