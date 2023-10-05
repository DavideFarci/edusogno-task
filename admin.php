<?php
$admin = ["davide.farci9@gmail.com"];

//Descrizione classe evento con proprietà
class Evento
{
    public $id;
    public $attendees;
    public $nome_evento;
    public $data_evento;

    public function __construct($id, $attendees, $nome_evento, $data_evento)
    {
        $this->id = $id;
        $this->attendees = $attendees;
        $this->nome_evento = $nome_evento;
        $this->data_evento = $data_evento;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setAttendees($attendees)
    {
        $this->attendees = $attendees;
    }

    public function getAttendees()
    {
        return $this->attendees;
    }

    public function setNomeEvento($nome_evento)
    {
        $this->nome_evento = $nome_evento;
    }

    public function getNomeEvento()
    {
        return $this->nome_evento;
    }

    public function setDataEvento($data_evento)
    {
        $this->data_evento = $data_evento;
    }

    public function getDataEvento()
    {
        return $this->data_evento;
    }
}

class EventController
{
    private $eventi = [];

    public function __construct($conn)
    {
        $this->eventi = [];
        $this->conn = $conn;
    }

    public function index()
    {
        // Query SQL per recuperare gli eventi dal database
        $sqlEventi = "SELECT * FROM eventi";
        $result = mysqli_query($this->conn, $sqlEventi);

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Creazione di oggetti Evento e aggiunta all'array $eventi
                $evento = new Evento($row['id'], $row['attendees'], $row['nome_evento'], $row['data_evento']);
                $eventi[] = $evento;
            }
            mysqli_free_result($result);
        }

        return $eventi;
    }

    public function store($attendees, $nome_evento, $data_evento)
    {

        $event = new Evento(null, $attendees, $nome_evento, $data_evento);
        $this->eventi[] = $event;

        include "database.php";
        // prevenire SQL injection
        $attendees = mysqli_real_escape_string($conn, $attendees);
        $nome_evento = mysqli_real_escape_string($conn, $nome_evento);
        $data_evento = mysqli_real_escape_string($conn, $data_evento);

        $sqlAdd = "INSERT INTO eventi (attendees, nome_evento, data_evento) VALUES ('$attendees', '$nome_evento', '$data_evento')";

        if (mysqli_query($conn, $sqlAdd)) {
            echo "Evento creato con successo!";
        } else {
            echo "Errore nell'inserimento dell'evento: " . mysqli_error($conn);
        }

        mysqli_close($conn);
    }

    public function update($id, $attendees,  $nome_evento, $data_evento)
    {
        // Query SQL per aggiornare l'evento nel database
        $sqlMod = "UPDATE eventi SET attendees = '$attendees',  nome_evento = '$nome_evento', data_evento = '$data_evento' WHERE id = '$id'";

        if (mysqli_query($this->conn, $sqlMod)) {
            echo "Evento aggiornato con successo!";
        } else {
            echo "Errore nell'aggiornamento dell'evento: " . mysqli_error($this->conn);
        }
    }

    public function delete($id)
    {
        // Cerco l'evento da eliminare e se esite lo elimino
        foreach ($this->eventi as $indice => $evento) {
            if ($evento->getId() === $id) {
                unset($this->eventi[$indice]);
                break;
            }
        }
        $sqlDel = "DELETE FROM eventi WHERE id = $id";

        if (mysqli_query($this->conn, $sqlDel)) {
            echo "Evento eliminato con successo!";
        } else {
            echo "Errore nell'eliminazione dell'evento: " . mysqli_error($this->conn);
        }
    }
}
