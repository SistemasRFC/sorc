<?php
class BaseDao{
    /*Método construtor do banco de dados*/
    public function BaseDao(){
        self::conect();
    }    
    
    Public Function __destruct() {
        self::disconnect();
    }
    private static $dbtype   = "mysql";
    private static $host     = "localhost";
    private static $port     = "3306";
    private static $user     = "sorc";
    private static $password = "Rfm1440@";
    private static $conexao = "";
    private static $db       = "sorc";
    public static $qtdRegistros = 0;
     
    /*Metodos que trazem o conteudo da variavel desejada
    @return   $xxx = conteudo da variavel solicitada*/
    private static function getDBType()  {return self::$dbtype;}
    private static function getHost()    {return self::$host;}
    private static function getPort()    {return self::$port;}
    private static function getUser()    {return self::$user;}
    private static function getPassword(){return self::$password;}
    private static function getDB()      {return self::$db;}

    Static function conect(){
        try{
            //self::$conexao = mysqli_connect(self::getHost(),self::getUser(),self::getPassword());                    
            self::$conexao = new mysqli(self::getHost(), self::getUser(), self::getPassword(), self::getDB());
            if(mysqli_connect_errno()){          
                print "Ocorreu um Erro na conexão MySQL:<b>".mysql_error()."</b>";
                die();
            }
        }catch(Exception $e){
            print "<b>".mysql_error()."</b>";
        }
    }

    private Static function disconnect(){
        self::$conexao = null;
    }
    /**
     * Método select que retorna um array de objetos
     */
    public Static function selectDB($sql, $objeto=true){
        //self::conect();    
        $resultado = mysqli_query(self::$conexao, $sql);
        if (!$resultado){
            $resulta[0] = false;
            $resulta[1] = " Erro: ".  mysqli_error(self::$conexao)."SQL: ".$sql;
            //self::disconnect();
        }else if($resultado){
            //self::disconnect();
            if ($objeto){    
                $resulta[0] = true;
                $resulta[1] = mysqli_fetch_object($resultado);
            }else{
                $resulta[0] = true;
                $resulta[1] = self::CarregaArray($resultado);
            }
        }
        return $resulta;
    }

    /**
     * Recebe um ResultSet e tranforma em um Array
     * @param ResultSet $array
     * @return Array
     */
    Private Static Function CarregaArray($array){
        $i=0;
        while ($rs = mysqli_fetch_array($array)){
            $resulta[$i] = $rs;
            $i++;
        }
        if(!isset($resulta)){
            $resulta = null;
        }        
        return $resulta;
    }
    /*Método insert que insere valores no banco de dados e retorna o último id inserido*/
    public static function insertDB($sql){
                
        if (mysqli_query(self::$conexao, $sql)){
            $result[0] = true;
            $result[1] = 'sucesso';
            $result[2] = mysqli_insert_id(self::$conexao);
        }else{
            $result[0] = false;
            $result[1] = mysqli_error(self::$conexao)."<br>".$sql;
        }
        //self::disconnect();
        return $result;
    }
    /*Método insert que insere valores no banco de dados e retorna o último id inserido*/
    public static function updateDB($sql, $id){
        self::conect();
        if (mysqli_query(self::$conexao, $sql)){
            $result[0] = true;
            $result[1] = 'sucesso';
            $result[2] = $id;
        }else{
            $result[0] = false;
            $result[1] = mysqli_error(self::$conexao)."<br>".$sql;
        }
        self::disconnect();
        return $result;
    }

    /**
     * Cria um objeto a partir de uma array
     * @param type $array
     * @return type
     */
    Public Function IniciaTransacao(){
        //mysqli_begin_transaction(self::$conexao);
        $this->insertDB('START TRANSACTION');
    }
    
    Public Function ComitaTransacao(){
        //mysqli_commit(self::$conexao);
        $this->insertDB('COMMIT');
    }
    
    Public Function RolbackTransacao(){
        //mysqli_rollback(self::$conexao);
        $this->insertDB('ROLLBACK');
    }
    
    public function getObject($array){
        if (isset($array[0])){
            return (object)$array[0];
        }else{
            return null;
        }
    }

    /**
     *  Pega o último código da tabela passada por parametro e acrescenta mais 1
     * @param <type> $tabela
     * @param <type> $codigo
     * @return <type>
     */
    static function CatchUltimoCodigo($tabela, $codigo){
        $sql = "
        SELECT COALESCE(MAX(".$codigo."),0)+1 AS ".$codigo." FROM ".$tabela;        
        $rs = self::selectDB($sql, false);
        if (!empty($rs)){
            return $rs[1][0][$codigo];
        }else{
            return 1;
        }
    }

    /**
     * Converte a data que vem do form para ser inserida no banco
     * @param <type> $data
     * @return <type>
     */
    function ConverteDataForm($data){
        if ($data!=''){
            $data = substr($data, 6,4).'-'.substr($data, 3,2).'-'.substr($data, 0,2);
        }else{
            $data='';
        }
        return $data;
    }

    Public Function GetDataAtual(){
        $sql = "SELECT NOW() AS DATA_ATUAL";
        $rs = $this->selectDB($sql, false);
        return $rs[0]['DATA_ATUAL'];
    }

    Public function Pivot1($tabela,
                         $tabelaPivot,
                         $campoPivot,
                         $outrosCampos,
                         $campoCont,
                         $alias,
                         $criterioPivot,
                         $criterioSelect,
                         $campoSomar){
        if ($tabelaPivot==''){
            $tabelaPivotear=$tabela;
        }else{
            $tabelaPivotear=$tabelaPivot;
        }
        $sql_group = "SELECT $campoPivot AS $campoPivot
                        FROM $tabelaPivotear
                        $criterioPivot
                       GROUP BY $campoPivot";
        $result_group = $this->selectDB($sql_group, false);
        $result_group = $result_group[1];
        $colunas='';
        for ($i=0;$i<count($result_group);$i++){
            if ($colunas==''){
                $colunas=''.$result_group[$i][$campoPivot];
            }else{
                $colunas=$colunas.','.$result_group[$i][$campoPivot];
            }
            $colunas.=' ';
        }
        if ($outrosCampos!=''){
            $sql_montada = "SELECT $outrosCampos,
                                   $campoCont as $alias";
        }else{
            $sql_montada = "SELECT $campoCont as $alias";
        }
        $j=0;
        $tamanho = strlen($colunas);
        while ($j<$tamanho){
            $palavra='';
            $palavra = $this->pegaPalavra($colunas, $j, $tamanho);
            $j=$j+strlen($palavra)+1;
            $sql_montada.=", SUM(CASE WHEN $campoPivot='$palavra' THEN $campoSomar ELSE 0 END) AS '$palavra'";
        }
        $sql_montada.= " FROM $tabela";
        if ($criterioSelect!=''){
            $sql_montada .= " $criterioSelect";
        }
        if ($outrosCampos!=''){
            $sql_montada .= " GROUP BY $outrosCampos, $campoCont
                              ORDER BY $outrosCampos, $campoCont";
        }
        return $sql_montada;
    }

    Public Function pegaPalavra($Texto, $inicio, $tamanho){
        $j=$inicio;
        $palavra='';
        while (($Texto[$j]!=',')&&
              ($j+1<$tamanho)){
            $palavra=$palavra.$Texto[$j];
            $j=$j+1;
        }
        return $palavra;
    }

    Public function IsDesenv($codUsuario){        
        $sql_lista = "SELECT COALESCE(COUNT(*),0) AS QTD
                        FROM SGA_SE_USUARIO U 
                      WHERE COD_USUARIO = $codUsuario"
                . "     AND COD_PERFIL_W = 1";
        $lista = $this->selectDB("$sql_lista", false);
        
        return $lista[1][0]['QTD'];
    }
}
?>
