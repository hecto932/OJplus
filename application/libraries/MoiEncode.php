<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

#Codigo desarrollado por: Moisés Alvarado
#twitter: m0ises2
#github: https://github.com/m0ises2
#email: moisesalvarado84@gmail.com

class MoiEncode
{
	//Variables requeridas:

	var $salt;
	
	#Contraseña (+ salt) a codificar:
	var $codificar;
	
	#Variables auxiliares:
	var $repreNumerica1;
	var $repreNumerica2;
	
	#HASH final:
	var $hash;

	#Archivo de módulos para las iteraciones:
	var $file;

	//Constructor:
	function __construct()
	{
		$this->salt = "LasBicicletasSonSaludVidaYBellezaFaCyTComputacionUniversidadDeCaraboboNaguanaguaVenezuelaJuezEnLineaRicardoMoisesyHectorDanielHR";
		$this->repreNumerica1 = "";
		$this->repreNumerica2 = "";
		$this->hash = "";
		$this->file = fopen("application/libraries/trance.txt","r");
	}

	//Métodos:
	public function encode($password)
	{

		$this->codificar .= $password.$this->salt;
		
		$len = strlen($this->codificar);

		for ($i=0; $i < $len; $i++)
		{ 
			#Funciòn ORD() devuelve el valor entero ASCII de un caracter.
			$e = ord(strtolower($this->codificar[$i]));
			
			$this->repreNumerica1 .= $e;
		}
		
		#Se realiza la primera iteración:
		$this->repreNumerica2 = bcmod($this->repreNumerica1,trim(fgets($this->file)));

		#Ciclo que lleva a cabo el resto de las iteraciones:
		while(!feof($this->file))
		{
			#Se lee desde el archivo de entrada el valor que será el divisor en cada iteración:
			$modulus = fgets($this->file);

			#Validación para asegurar que la lectura no es el valor booleano "false":
			if($modulus)
			{
				#Se realiza el módulo:
				$this->repreNumerica2 = bcmod($this->repreNumerica2,trim($modulus));				
			}
		}

		$len = strlen($this->repreNumerica2);

		#Se convierte la representación numérica resultante en una cadena de caracteres que representa el Hash final:
		for($i=0;$i<$len;$i++)
		{
			#Se convierte el dígito en un caracter de la tabla ASCII.
			$this->hash .= chr($this->repreNumerica2[$i]+61);
		}

		fclose($this->file);

		return $this->hash;
	}
}

/* End of file MoiEncode.php */
/* Location: ./application/libraries/MoiEncode.php */