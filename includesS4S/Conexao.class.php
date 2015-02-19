 <?php 
/** 
 * Conexao com MySQL 
 * Essa classe herda a superclasse mysqli 
 * e necessario que a extensao mysqli esteja habilitada 
 * 
 */
class Conexao extends mysqli { 
  
    /** 
     * Connected 
     * propriedade privada para 'indicar' 
     * o estado da conexao 
     * 
     * @var boolean 
     * @static 
     */
    private static $_connected = false; 
  
    /** 
     * Instancia Conexao 
     * propriedade para a implementacao do design pattern singleton 
     * 
     * @var Conexao 
     * @static 
     */
    private static $_instance = null; 
  
    /** 
     * Destrutor 
     * Quando o objeto for destruido a conexao e fechada 
     * 
     * @param void 
     * @return void 
     */
    public function  __destruct() { 
  
        $this->close(); 
    } 
  
    /** 
     * Retorna Conexao 
     * Esse metodo verifica se ja existe na memoria uma instancia 
     * da classe de Conexao 
     * Se existir apenas retorna 
     * se nao instancia 
     * 
     * @param void 
     * @return Conexao 
     */
    public static function getInstance() { 
  
        if (null === self::$_instance) { 
  
            self::$_instance = new self (); 
        } 
  
        return self::$_instance; 
    } 
  
    /** 
     * Conecta no banco 
     * Utiliza o construtor da superclasse 
     * 
     * @param void 
     * @return void 
     */
    public function connect() { 
        //se nao estiver conectado 
        if(!self::$_connected) { 
            // parent::__construct( 
            //         'localhost', 
            //         'root', 
            //         '', 
            //         'portal_gourmand'
            // ); 
            parent::__construct( 
               '189.126.99.226', 
               'portal_gourmand', 
               'BlRj@15', 
               'portal_gourmand'
            ); 

            //se der erro na conexao gera uma excessao 
            if(mysqli_connect_errno()) { 
                throw new Exception('A Conexao falhou: '.mysqli_connect_error()); 
            } 
  
            self::$_connected = true; 
        } 
    } 
  
    /** 
     * Fecha a conexao 
     * Sobrescreve o metodo close da superclasse 
     * 
     * @param void 
     * @return void 
     */
    public function close() { 
  
        if(self::$_connected) { 
            parent::close(); 
            self::$_connected = false; 
        } 
    } 
  
    /** 
     * Consulta 
     * Sobreescreve o metodo da superclasse 
     * 
     * @param string $sql 
     * @return mysqli_result Object 
     */
    public function query($sql) { 
        //'tenta' conectar 
        $this->connect(); 
        $result = parent::query($sql); 
  
        if($result) { 
  
            return $result; 
        } 
        else { 
            //se der erro gera uma excessao 
            throw new Exception('Query Exception: '.mysqli_error($this).' numero:'.mysqli_errno($this)); 
        } 
    } 
  
    /** 
     * Ping servidor banco 
     * Sobreescreve o metodo da superclasse 
     * 
     * @return boolean 
     */
    public function ping() { 
        // se estiver conectado retorna verdadeiro 
        if(@mysqli_ping($this)) { 
            return true; 
        } 
        else { 
            return false; 
        } 
    } 
} 


?>
