<?php
class RendezVousController extends Controller {
    private $rendezVousModel;
    private $medecinModel;
    
    public function __construct() {
        $this->rendezVousModel = new RendezVous();
        $this->medecinModel = new Medecin();
    }
    
    public function showPriseRendezVous() {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/login');
        }
        
        $medecins = $this->medecinModel->findAll();
        $this->render('rendezvous/create', [
            'medecins' => $medecins,
            'csrf_token' => $this->generateCSRFToken()
        ]);
    }
    
    public function createRendezVous() {
        $this->validateCSRF();
        
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/login');
        }
        
        $data = [
            'patient_id' => $_SESSION['user_id'],
            'medecin_id' => filter_input(INPUT_POST, 'medecin_id', FILTER_SANITIZE_NUMBER_INT),
            'date_heure' => filter_input(INPUT_POST, 'date_heure', FILTER_SANITIZE_STRING),
            'motif' => filter_input(INPUT_POST, 'motif', FILTER_SANITIZE_STRING)
        ];
        
        if ($this->rendezVousModel->createAppointment($data)) {
            // Envoyer un email de confirmation
            $this->sendConfirmationEmail($data);
            $this->redirect('/mes-rendez-vous');
        } else {
            $medecins = $this->medecinModel->findAll();
            $this->render('rendezvous/create', [
                'medecins' => $medecins,
                'error' => 'Erreur lors de la prise de rendez-vous',
                'csrf_token' => $this->generateCSRFToken()
            ]);
        }
    }
    
    private function sendConfirmationEmail($data) {
        // Code pour envoyer un email de confirmation
        $to = $_SESSION['user_email'];
        $subject = "Confirmation de votre rendez-vous";
        $message = "Votre rendez-vous a été confirmé pour le " . $data['date_heure'];
        mail($to, $subject, $message);
    }
    
    public function showMesRendezVous() {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/login');
        }
        
        $rendezVous = $this->rendezVousModel->getPatientAppointments($_SESSION['user_id']);
        $this->render('rendezvous/liste', [
            'rendezVous' => $rendezVous
        ]);
    }
}