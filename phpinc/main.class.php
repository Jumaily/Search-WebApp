<?php
class Main extends SQLite3{
   private $sqliteDB = sqliteDB;
   private $connect;
   public $fname;
   public $lname;
   public $title;
   public $dept;


   public function __construct(){
      $this->open($this->sqliteDB);
      $this->connect = new SQLite3($this->sqliteDB);

      if(isset($_GET["firstname"])){ $this->fname = ucfirst(strtolower(preg_replace('/[^da-z]\s+/i', '', $_GET["firstname"]))); }
      if(isset($_GET["lastname"])){ $this->lname = ucfirst(strtolower(preg_replace('/[^da-z]\s+/i', '', $_GET["lastname"]))); }
      if(isset($_GET["title"])){ $this->title = preg_replace('/[^da-z]\s+/i', '', $_GET["title"]); }
      if(isset($_GET["dept"])){ $this->dept = preg_replace('/[^da-z]\s+/i', '', $_GET["dept"]); }

      }


   public function __destruct(){
      $this->connect->close();
      unset($this->connect);
      }


   # Search employee by name
   public function auto_complete($srch){
      $rows = array();
      $keyword = $this->sanitize($_POST['keyword']);
      if(!empty($keyword) && $keyword != '' ){
         $sql = "SELECT Distinct $srch FROM salaries WHERE $srch LIKE '%$keyword%' ORDER BY $srch ASC LIMIT 0, 10";
         $linkb = $this->connect->query($sql);
         while($row = $linkb->fetchArray(SQLITE3_ASSOC)){
            array_push($rows,$row);
            }
         }
      return $rows;
      }

   # Search employee by name
   public function search_byname(){
      $rows = array();
      if(!empty($this->lname) || !empty($this->fname)){
         $linkb = $this->connect->query("SELECT id,name_first,name_last,title,salary FROM salaries WHERE name_first LIKE '{$this->fname}%' AND name_last LIKE '{$this->lname}%' LIMIT 20");
         while($row = $linkb->fetchArray(SQLITE3_ASSOC)){
            array_push($rows,$row);
            }
         }
      return $rows;
      }

   public function lookupbydepartment(){
      $rows = array();
      $dept = $this->sanitize($this->dept);
      if($dept!=''){
         $linkb = $this->connect->query("SELECT id,name_last,name_first,title,salary,dept FROM salaries WHERE dept LIKE '%$dept%' ORDER BY salary DESC LIMIT 1000");
         while($row = $linkb->fetchArray(SQLITE3_ASSOC)){
            array_push($rows,$row);
            }
         }
      return $rows;
      }

   # look up by titles
   public function lookupbytitle(){
      $rows = array();
      $title = $this->sanitize($this->title);
      if($title!=''){
         $linkb = $this->connect->query("SELECT id,name_last,name_first,title,salary,dept FROM salaries WHERE title LIKE '%$title%' ORDER BY salary DESC LIMIT 1000");
         while($row = $linkb->fetchArray(SQLITE3_ASSOC)){
            array_push($rows,$row);
            }
         }
      return $rows;
      }


   # Search Employee by id
   public function lookupbyid(){
      $dbid = preg_replace('/[^\d-]+/', '', $_GET["dbid"]);
      $rows = array();
      if($dbid >=1 ){
         $linkb = $this->connect->query("SELECT * FROM salaries WHERE id=$dbid LIMIT 1");
         while($row = $linkb->fetchArray(SQLITE3_ASSOC)){
            array_push($rows,$row);
            }
         }
      return $rows;
      }


   # Clean & Sanitize then Return Input
   function cleanInput($input) {
      $search = array(
                '@<script[^>]*?>.*?</script>@si',   // Strip out javascript
                '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
                '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
                '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
                );
      $output = preg_replace($search, '', $input);
      return $output;
      }

   // Sanitization function
   function sanitize($input) {
       if (is_array($input)) {
         foreach($input as $var=>$val){ $output[$var] = sanitize($val); }
         }
       else {
         if (get_magic_quotes_gpc()){ $input = stripslashes($input); }
         $output  = $this->cleanInput($input);
         }
       return $output;
      }




   }
?>
