<?php

class DAO
{
  private static $instance = null;
  private PDO $db;
  private string $database = 'sqlite:' . __DIR__ . '/../data/crescendo.db'; //SQLITE
  //private string $database = 'pgsql:host=localhost;port=5433;dbname=crescendo;user=crescendo;password=crescendo;'; // Postgresql 

  private function __construct()
  {
    try {
      $this->db = new PDO($this->database);
      if (!$this->db) {
        throw new Exception($this->database . " ne peut pas être ouvert");
      }
      // Mettre les erreurs en exception
      $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      throw new PDOException(__METHOD__ . " at " . __LINE__ . ": " . $e->getMessage() . " DataBase=\"" . $this->database . '"');
    }
  }

  public static function get(): DAO
  {
    if (is_null(self::$instance)) {
      self::$instance = new DAO();
    }
    return self::$instance;
  }


  /**
   * Pour faire des SELECT sur la base de données
   * @param string $query la requête
   * @param array $data les données à remplacer dans la reqûete
   * @throws PDOException
   * @return array
   */
  public function query(string $query, array $data): array
  {
    try {
      $s = $this->db->prepare($query);
      $s->execute($data);
    } catch (Exception $e) {
      throw new PDOException(__METHOD__ . " at " . __LINE__ . ": " . $e->getMessage() . " Query=\"" . $query . '"');
    }

    if ($s === false) {
      throw new PDOException(__METHOD__ . " at " . __LINE__ . ": " . implode('|', $this->db->errorInfo()) . " Query=\"" . $query . '"');
    }
    $table = $s->fetchAll();
    return $table;
  }

  /**
   * Faire des CREATE, UPDATE, DELETE sur la base de données
   * @param string $query la requête SQL
   * @param array $data les données à remplacer dans la reqûete
   * @return void
   */
  public function exec(string $query, array $data)
  {
    $s = $this->db->prepare($query);
    $s->execute($data);
  }
}
?>