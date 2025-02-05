<?php
// app/models/Medecin.php
// namespace App\Models;

// use Core\Model;

class Medecin extends Model {
    protected $table = 'medecins';

    public function __construct() {
        parent::__construct();
        $this->table = 'medecins';
    }

    public function findBySpecialty($specialty) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE specialty = :specialty");
        $stmt->execute(['specialty' => $specialty]);
        return $stmt->fetchAll();
    }

    public function getAvailableTimeSlots($medecinId, $date) {
        $stmt = $this->db->prepare("
            SELECT time_slot 
            FROM time_slots 
            WHERE medecin_id = :medecin_id 
            AND date = :date 
            AND is_available = true
        ");
        $stmt->execute([
            'medecin_id' => $medecinId,
            'date' => $date
        ]);
        return $stmt->fetchAll();
    }

    public function getDashboardStats($medecinId) {
        $stats = [];
        
        // Total appointments this month
        $stmt = $this->db->prepare("
            SELECT COUNT(*) as total_appointments 
            FROM rendezvous 
            WHERE medecin_id = :medecin_id 
            AND EXTRACT(MONTH FROM date) = EXTRACT(MONTH FROM CURRENT_DATE)
        ");
        $stmt->execute(['medecin_id' => $medecinId]);
        $stats['total_appointments'] = $stmt->fetch()['total_appointments'];

        // Patients this month
        $stmt = $this->db->prepare("
            SELECT COUNT(DISTINCT patient_id) as unique_patients 
            FROM rendezvous 
            WHERE medecin_id = :medecin_id 
            AND EXTRACT(MONTH FROM date) = EXTRACT(MONTH FROM CURRENT_DATE)
        ");
        $stmt->execute(['medecin_id' => $medecinId]);
        $stats['unique_patients'] = $stmt->fetch()['unique_patients'];

        return $stats;
    }
}