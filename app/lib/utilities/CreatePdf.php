<?php
namespace App\Lib\Utilities;
use Core\Model;
use Mpdf\Mpdf;

class CreatePdf {

  public $mPdf;

  public function __construct() {
    require_once (ROOT . DS . 'vendor/autoload.php');
  }

  public function createPdfFile(){

    $location = ROOT . DS . 'uploads' . DS . 'pdf_files' . DS;

    $this->mPdf = new Mpdf([
      'mode' => 'utf-8',
      'format' => [210, 297],
      'orientation' => 'L'
    ]);
    $this->mPdf->writeHTML('Hello World');
    $this->mPdf->Output($location . 'TestFile.pdf', \Mpdf\Output\Destination::FILE);
  }

  public function createBookingPdf($params){
    $location = ROOT . DS . 'uploads' . DS . 'pdf_files' . DS . 'bookings' . DS . $params->user_id . DS;
    // $stylesheet = file_get_contents(PROOT . 'assets/css/booking.css');

    if(!file_exists($location)){
      mkdir($location);
    }
    $html = '
    <html>
      <head>
        <style>
          @import url('. PROOT . 'assets/css/booking.css)
        </style>
      </head>
      <body>
        <header>
          <table>
            <thead>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
            </thead>
            <tbody>
              <tr>
                <td colspan="2"><img class="headerImg" src="'.PROOT.'assets/img/gullman_mvc_dark.png"></td>
                <td colspan="2"><h2 class="bookingHeader">Booking</h2> <p>'.$params->booking_nr.'</p></td>
              </tr>
              <tr>
                <td class="tableHeading" colspan="4"><hr></td>
              </tr>
              <tr>
                <td class="tableHeading" colspan="4"><h3>Booking Info</h3></td>
              </tr>
              <tr>
                <td colspan="2"><span style="font-weight: bold;">Name: </span>'.$params->name.'</td>
                <td colspan="2"><span style="font-weight: bold;">City: </span>'.$params->city.'</td>
              </tr>
              <tr>
                <td colspan="2"><span style="font-weight: bold;">Email: </span>'.$params->email.'</td>
                <td colspan="2"><span style="font-weight: bold;">Address: </span>'.$params->address.'</td>
              </tr>
              <tr>
                <td colspan="2"><span style="font-weight: bold;">Phone: </span>'.$params->phone1 . '</td>
                <td colspan="2"><span style="font-weight: bold;">Purpose: </span>'.$params->purpose.'</td>
              </tr>
              <tr>
                <td class="tableHeading" colspan="4"><h3>Booking Date</h3></td>
              </tr>
              <tr>
                <td colspan="2"><span style="font-weight: bold;">Date: </span>'.$params->date . '</td>
                <td colspan="2"><span style="font-weight: bold;">Time: </span>'.$params->time.'</td>
              </tr>
              <tr>
                <td class="tableHeading" colspan="4"><h3>Booking Includes</h3></td>
              </tr>
              <tr>
                <td colspan="4"><span style="font-weight: bold;">Travle Supplement: </span>'.$params->travle_supplement . '</td>
              </tr>
              <tr>
                <td colspan="4"><span style="font-weight: bold;">Booking Includes:</td>
              </tr>
              <tr>
                <td colspan="4"><p class="bookingIncludes">'.$params->outher .'</p></td>
              </tr>
            </tbody>
          </table>
        </header>
        <section class="infoText">
          <h4>avtalet avser</h3>
          <table>
            <thead>
              <th></th>
              <th></th>
            </thead>
            <tbody>
              <tr>
                <td class="p-info">
                  <h5 class="h5-info">Viktigt:</h5>
                  <p class="infoText-p">Bokaren  ansvarar för att deltagarna vet att eventet sker på egen risk + att överförfriskade ej får deltaga, men debiteras ändå. Skaderisken är i stort sett obefintlig för friska personer, men ha i beaktning på gamla skador och exempelvis nackproblem.</p>
                </td>
                <td class="p-info">
                  <h5 class="h5-info">Avbokning:</h5>
                  <p class="infotext-p">Bokningen är bindande. Avbokning sker skriftligt. Vid avbokning senare än en vecka innan eventet är du betalningsskyldig 50% av eventkostnader. Om ni har skjukintyg så får du tillbaka hela beloppet minus 150:- i administrationsavgift.</p>
                </td>
              </tr>
              <tr>
                <td class="p-info">
                  <h5 class="h5-info">Betalning:</h5>
                  <p class="infoText-p">Betalning sker antingern på plats med swich eller via förskottsfaktura. Vid förskottsbetalning till bankgiro: 8735961, uppge bokningsnummer i meddelande fältet.</p>
                </td>
                <td class="p-info">
                  <h5 class="h5-info">Utrustning:</h5>
                  <p class="infotext-p">All nödvändig utrustning ingår.</p>
                </td>
              </tr>
            </tbody>
          </table>
          <h2>Tack för din förfrågan!</h2>
          <hr>
          <table>
            <thead>
              <th></th>
              <th></th>
            </thead>
            <tbody>
              <tr>
                <td></td>
                <td style="text-align: right">
                  <h4>Med vänliga hälsningar</h4>
                  <p class="contact-p-name">Niklas Luthin</p>
                  <p class="contact-p">Tel & Sms: 0708-171260</p>
                  <p class="contact-p">E-post: luthin@live.se</p>
                  <p class="contact-p">www.eventhalland.se</p>
                </td>
              </tr>
            </tbody>
          </table>
        </section>
      </body>
    </html>
    ';

    $this->mPdf = new Mpdf([
      'mode' => 'utf-8',
      'format' => [210, 297],
      'orientation' => 'P',
      'margin_left' => 20,
      'margin_right' => 15,
    ]);
    // $this->mPdf->WriteHTML('Hello World');
    // $this->mPdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
    $this->mPdf->WriteHTML($html);
    $pdf = $this->mPdf->Output($location . $params->booking_nr . '.pdf', \Mpdf\Output\Destination::FILE);

    if($pdf){
      return true;
    }

  }
}

?>