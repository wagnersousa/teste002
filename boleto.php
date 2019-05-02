<?php
/*
 * Name: boleto
 * Version: 1.0
 * Date: 02/02/2017 -
 * Author: Raif Carneiro Gomes- raif.carneiro@gmail.com
 * Description: boletos bancários
 * 
 */

class boletosPHP {
    private $barras;
    private $codBanco; // Código do Banco
    private $codMoeda; // Moeda 
    private $fatorVencimento; // Numero de dias desde 1997
	private $dtVencimento; // Data de vencimento
    private $valorDocumento;
    private $nossoNumero; // Identificador Uníco de um boleto
	private $bancoDocumento; // Documento pertencente ao BAnco
   

    /* ============= SETS ============== */
    
    

    public function setBarras($barras) {
        //Setando Código de Barras
        $this -> barras = $barras;
    }


	
	
    /* ===================== GETS ========================= */
   

    public function getBarras() { //ok
        //Pegando Código de Barras
        return $this -> barras;
    }
	

    public function getCodBanco() {//ok
        //Pegando Código do Banco
		$this -> codBanco = substr($this -> barras, 0, 3);
        return $this -> codBanco;
    }
	
	
	

    public function getCodMoeda() { //ok
        //Pegando Código da Moeda

        $this -> codMoeda = substr($this -> barras, 3,1);   
        return $this -> codMoeda;
    }

	
	public function getFatorVencimento() { //ok
        //Pegando fator do vencimento
       
        $this -> fatorVencimento = substr($this -> barras, -14, -10);
    
        return $this -> fatorVencimento;
    }
	
	
	
    

    public function getDtVencimento() { //ok
        //Pegando data de vencimento
        
        $this ->calcDtVencimento(substr($this -> barras, -14, -10));
 
        return $this -> dtVencimento;
    }
	

    
	

    public function getValorDocumento() {//ok
        //Pegando Valor do documento
        
        $this -> valorDocumento = substr($this -> barras, -10, 10);
            
        
        $valor = substr($this -> valorDocumento, 0, 8) . "." . substr($this -> valorDocumento, 8, 2);
        
        $caractere = substr($valor, 1,1);
        
        while($caractere=='0'){
            $valor = substr_replace($valor, "", 0, 1);
            $caractere = substr($valor, 1,1);
        }
        
        (double) $valor_double = $valor; 
        
        return number_format($valor_double, 2, ",", ".");
    }
	
	
	
    
    public function getNossoNumero(){ //ok
        //Pegando Nosso Número
        
        $this -> nossoNumero = substr($this -> barras, 15, 10);
            
        return $this->nossoNumero;
    }
    

     public function getBanco() { //ok
        //Pegando Código de Barras
		 $cod_banco= substr($this -> barras, 0, 3);
		 $aux=" ";
		 switch($cod_banco){
			case "001":	
				$aux= "Banco do Brasil";
				 break;
			case "237":	
				$aux= "Bradesco";
				 break;
			 case "104":	
				$aux= "Caixa Econômica";
				 break;
			 case "399"	:
				$aux= "HSBC";
				break;
			 case "184"	:
				$aux= "Itaú";
				 break;
			 case "033":	
				$aux= "Santander";
			 	break;
			 case "409"	:
				$aux= "Unibanco";
			 	break;
			 default:
			 	$aux= "Banco Não Cadastrado";
		 }
			 
			 $bancoDocumento= $aux;
			 return $bancoDocumento;
        
    }
	
   

    /* ================  CAlCULOS  ===================*/
    
    
   private function calcDtVencimento($fator) { //ok
        // $base = new Date("07/10/1997"); Dia Base para geração de Vencimentos
        $this -> dtVencimento = date("d/m/Y", strtotime("+".$fator."days",strtotime("07-10-1997")));
		 
    }
}
?>