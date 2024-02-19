<?

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Email;

class MailController extends Controller {
    public function index($password)
    {
        try {
            Mail::to('priconne45703@gmail.com')->send(new Email($password));
            return response()->json(['message' => 'Email sent successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Email failed to send']);
        }
    }
}