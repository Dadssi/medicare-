<?php
class RendezVous extends Model {
    protected $table = 'rendez_vous';
    
    public function createAppointment($data) {
        return $this->create([
            'patient_id' => $data['patient_id'],
            'medecin_id' => $data['medecin_id'],
            'date_heure' => $data['date_heure'],
            'motif' => $data['motif'],
            'status' => 'en_attente'
        ]);
    }
    
    public function getPatientAppointments($patientId) {
        $query = "SELECT rv.*, m.nom as medecin_nom 
                 FROM rendez_vous rv 
                 JOIN medecins m ON rv.medecin_id = m.id 
                 WHERE rv.patient_id = :patient_id 
                 ORDER BY rv.date_heure";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['patient_id' => $patientId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getMedecinAppointments($medecinId) {
        $query = "SELECT rv.*, p.nom as patient_nom 
                 FROM rendez_vous rv 
                 JOIN patients p ON rv.patient_id = p.id 
                 WHERE rv.medecin_id = :medecin_id 
                 ORDER BY rv.date_heure";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['medecin_id' => $medecinId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}