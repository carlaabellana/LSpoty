<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\RoundBlockSizeMode;

/**
 * Controller that manages the creation of a QR for the user, it uses an external library we uploaded using Composer.
 */
class QrController extends Controller
{
    /**
     * Method responsible for rendering a QR code based on the users ID, we use some external libraries to create this
     * element and define its characteristics.
     *
     * @return \CodeIgniter\HTTP\ResponseInterface PNG containing the QR
     * @throws \Endroid\QrCode\Exception\ValidationException Triggered if the QR is invalid
     */
    public function index()
    {
        //The user ID is retrieved from session or put a default.
        $userId = session('user_id') ?? 'guest';

        //URL is created for the user profile.
        $url = base_url('/user/' . $userId);

        //The QR builder is created with the corresponding parameters.
        $builder = new Builder(
            writer: new PngWriter(),                                  //The output format is PNG
            writerOptions: [],                                        //Empty
            validateResult: false,                                    //The result validation is disabled
            data: $url,                                               //User profile URL that will be on the QR
            encoding: new Encoding('UTF-8'),                    //Character encoding
            errorCorrectionLevel: ErrorCorrectionLevel::Low,          //Level for error correction
            size: 100,                                                //Size of QR
            margin: 10,                                               //Margin around
            roundBlockSizeMode: RoundBlockSizeMode::Margin,           //Adjust block size
            foregroundColor: new Color(0, 0, 0),      //Black as foreground colour
            backgroundColor: new Color(255, 255, 255) //White as background colour
        );

        //The image of the QR is builded.
        $result = $builder->build();

        //The image is returned as a PNG and the corresponding headers.
        return $this->response
            ->setContentType('image/png')
            ->setBody($result->getString());
    }
}
