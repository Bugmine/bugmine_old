<?php

/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.2.4 or newer
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright	Copyright (c) 2014, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

$lang['email_must_be_array'] = 'Der E-Mail-Validierungsmethode muss ein Array übergeben werden.';
$lang['email_invalid_address'] = 'Ung&uuml;ltige E-Mail-Adresse: %s';
$lang['email_attachment_missing'] = 'Der Dateianhang %s wurde nicht gefunden.';
$lang['email_attachment_unreadable'] = 'Der Dateianhang %s konnte nicht ge&ouml;ffnet werden.';
$lang['email_no_recipients'] = 'Es muss mindestens ein Empf&auml;nger (To, Cc oder Bcc) angegeben werden.';
$lang['email_send_failure_phpmail'] = 'Der E-Mail-Versand &uuml;ber die PHP-Funktion mail() ist fehlgeschlagen. Der Server muss m&ouml;glicherweise für diese Methode konfiguriert werden.';
$lang['email_send_failure_sendmail'] = 'Der E-Mail-Versand &uuml;ber sendmail ist fehlgeschlagen. Der Server muss m&ouml;glicherweise für diese Methode konfiguriert werden.';
$lang['email_send_failure_smtp'] = 'Der E-Mail-Versand &uuml;ber SMTP ist fehlgeschlagen. Der Server muss m&ouml;glicherweise für diese Methode konfiguriert werden.';
$lang['email_sent'] = 'Die Nachricht wurde erfolgreich mittels %s versandt.';
$lang['email_no_socket'] = 'Es konnte kein Socket f&uuml;r Sendmail ge&ouml;ffnet werden. Bitte pr&uuml;fen Sie die Einstellungen.';
$lang['email_no_hostname'] = 'Es wurde kein SMTP-Hostname angegeben.';
$lang['email_smtp_error'] = 'Der SMTP-Fehler %s ist aufgetreten';
$lang['email_no_smtp_unpw'] = 'SMTP-Benutzername und -Passwort m&uuml;ssen angegeben werden.';
$lang['email_failed_smtp_login'] = 'Der AUTH LOGIN-Befehl konnte nicht gesendet werden. Fehler: %s';
$lang['email_smtp_auth_un'] = 'Der Benutzername ist nicht g&uuml;ltig. Fehler: %s';
$lang['email_smtp_auth_pw'] = 'Das Passwort ist nicht g&uuml;ltig. Fehler: %s';
$lang['email_smtp_data_failure'] = 'Die Daten konnten nicht versandt werden: %s';
$lang['email_exit_status'] = 'Abbruch mit Statuscode: %s';

/* End of file email_lang.php */
/* Location: ./system/language/english/email_lang.php */