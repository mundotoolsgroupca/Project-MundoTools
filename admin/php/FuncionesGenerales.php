<?php
function eliminar_palabras_sql($cadena)
{
    // $palabras_reservadas = array('/\bSELECT\b/i', '/\bINSERT\b/i', '/\bUPDATE\b/i', '/\bDELETE\b/i', '/\bDROP\b/i', '/\bTABLE\b/i', '/\bWHERE\b/i', '/\bFROM\b/i', '/\bAND\b/i', '/--/', '/\*/', '/\bJOIN\b/i', '/\bGROUP\b/i', '/\bORDER\b/i', '/\bBY\b/i', '/\bOR\b/i', '/\bIF\b/i', '/\bELSE\b/i', '/\BCASE\b/i', '/\BBEGIN\b/i', '/\BEND\b/i', '/\BSET\b/i', '/["\']+/');

    $palabras_reservadas = array(
        '/\bABSOLUTE\b\s/i',
        '/\bANY\b\s/i',
        '/\bADD\b\s/i',
        '/\bARE\b\s/i',
        '/\bADMINDB\b\s/i',
        '/\bAS\b\s/i',
        '/\bALL\b\s/i',
        '/\bASC\b\s/i',
        '/\bAlphanumeric\b\s/i',
        '/\bTEXT\b\s/i',
        '/\bASSERTION\b\s/i',
        '/\bALTER\b\s/i',
        '/\bAUTHORIZATION\b\s/i',
        '/\bALTER TABLE\b\s/i',
        '/\bAUTOINCREMENT\b\s/i',
        '/\bCOUNTER\b\s/i',
        '/\bAnd\b\s/i',
        '/\bAvg\b\s/i',
        '/\bASb/i',
        '/\bBEGIN\b\s/i',
        '/\bCOLLATION\b\s/i',
        '/\bBetween\b\s/i',
        '/\bCOLUMN\b\s/i',
        '/\bBINARY\b\s/i',
        '/\bCOMMIT\b\s/i',
        '/\bBIT\b\s/i',
        '/\bCOMP\b\s/i',
        '/\bBIT_LENGTH\b\s/i',
        '/\bCONNECT\b\s/i',
        '/\bBOOLEAN\b\s/i',
        '/\bBIT\b\s/i',
        '/\bCONNECTION\b\s/i',
        '/\bBOTH\b\s/i',
        '/\bCONSTRAINT\b\s/i',
        '/\bCONSTRAINTS\b\s/i',
        '/\bCOMPRESSION\b\s/i',
        '/\bBY\b\s/i',
        '/\bCONTAINER\b\s/i',
        '/\bBYTE\b\s/i',
        '/\bCONTAINS\b\s/i',
        '/\bCASCADE\b\s/i',
        '/\bCONVERT\b\s/i',
        '/\bCATALOG\b\s/i',
        '/\bCount\b\s/i',
        '/\bCHAR\b\s/i',
        '/\bCHARACTER\b\s/i',
        '/\bTEXT\b\s/i',
        '/\bCOUNTER\b\s/i',
        '/\bCHAR_LENGTH\b\s/i',
        '/\bCREATE\b\s/i',
        '/\bCHARACTER_LENGTH\b\s/i',
        '/\bCURRENCY\b\s/i',
        '/\bCHECK\b\s/i',
        '/\bCURRENT_DATE\b\s/i',
        '/\bCLOSE\b\s/i',
        '/\bCURRENT_TIME\b\s/i',
        '/\bCLUSTERED\b\s/i',
        '/\bCURRENT_TIMESTAMP\b\s/i',
        '/\bCOALESCE\b\s/i',
        '/\bCURRENT_USER\b\s/i',
        '/\bCOLLATE\b\s/i',
        '/\bCURSOR\b\s/i',
        '/\bDATABASE\b\s/i',
        '/\bDISALLOW\b\s/i',
        '/\bDATE\b\s/i',
        '/\bDATETIME\b\s/i',
        '/\bDISCONNECT\b\s/i',
        '/\bDATETIME\b\s/i',
        '/\bDISTINCT\b\s/i',
        '/\bDAY\b\s/i',
        '/\bDISTINCTROW\b\s/i',
        '/\bDEC\b\s/i',
        '/\bDECIMAL\b\s/i',
        '/\bDOMAIN\b\s/i',
        '/\bDECLARE\b\s/i',
        '/\bDOUBLE\b\s/i',
        '/\bDELETE\b\s/i',
        '/\bDROP\b\s/i',
        '/\bDESC\b\s/i',
        '/\bEqv\b\s/i',
        '/\bFOREIGN\b\s/i',
        '/\bEXCLUSIVECONNECT\b\s/i',
        '/\bFROM\b\s/i',
        '/\bEXEC\b\s/i',
        '/\bEXECUTE\b\s/i',
        '/\bEXISTS\b\s/i',
        '/\bGENERAL\b\s/i',
        '/\bLONGBINARY\b\s/i',
        '/\bEXTRACT\b\s/i',
        '/\bGRANT\b\s/i',
        '/\bFALSE\b\s/i',
        '/\bGROUP\b\s/i',
        '/\bFETCH\b\s/i',
        '/\bGUID\b\s/i',
        '/\bFIRST\b\s/i',
        '/\bHAVING\b\s/i',
        '/\bFLOAT\b\s/i',
        '/\bFLOAT8\b\s/i',
        '/\bDOUBLE\b\s/i',
        '/\bHOUR\b\s/i',
        '/\bFLOAT4\b\s/i',
        '/\bSINGLE\b\s/i',
        '/\bIDENTITY\b\s/i',
        '/\bINPUT\b\s/i',
        '/\bIEEEDOUBLE\b\s/i',
        '/\bDOUBLE\b\s/i',
        '/\bINSENSITIVE\b\s/i',
        '/\bIEEESINGLE\b\s/i',
        '/\bSINGLE\b\s/i',
        '/\bINSERT\b\s/i',
        '/\bIGNORE\b\s/i',
        '/\bINSERT INTO\b\s/i',
        '/\bIMAGE\b\s/i',
        '/\bINT\b\s/i',
        '/\bINTEGER\b\s/i',
        '/\bINTEGER4\b\s/i',
        '/\bLONG\b\s/i',
        '/\bImp\b\s/i',
        '/\bINTEGER1\b\s/i',
        '/\bBYTE\b\s/i',
        '/\bIn\b\s/i',
        '/\bINTEGER2\b\s/i',
        '/\bSHORT\b\s/i',
        '/\bIN\b\s/i',
        '/\bINTERVAL\b\s/i',
        '/\bINDEX\b\s/i',
        '/\bINTO\b\s/i',
        '/\bINDEXCREATEDB\b\s/i',
        '/\bIs\b\s/i',
        '/\bINNER\b\s/i',
        '/\bISOLATION\b\s/i',
        '/\bJOIN\b\s/i',
        '/\bLONGTEXT\b\s/i',
        '/\bKEY\b\s/i',
        '/\bLOWER\b\s/i',
        '/\bLANGUAGE\b\s/i',
        '/\bMATCH\b\s/i',
        '/\bLAST\b\s/i',
        '/\bMax\b\s/i',
        '/\bLEFT\b\s/i',
        '/\bMEMO\b\s/i',
        '/\bLONGTEXT\b\s/i',
        '/\bLevel*\b\s/i',
        '/\bMin\b\s/i',
        '/\bLike\b\s/i',
        '/\bMINUTE\b\s/i',
        '/\bLOGICAL\b\s/i',
        '/\bLOGICAL1\b\s/i',
        '/\bBIT\b\s/i',
        '/\bMod\b\s/i',
        '/\bLONG\b\s/i',
        '/\bMONEY\b\s/i',
        '/\bCURRENCY\b\s/i',
        '/\bLONGBINARY\b\s/i',
        '/\bMONTH\b\s/i',
        '/\bLONGCHAR\b\s/i',
        '/\bNATIONAL\b\s/i',
        '/\bOuter*\b\s/i',
        '/\bNCHAR\b\s/i',
        '/\bOUTPUT\b\s/i',
        '/\bNONCLUSTERED\b\s/i',
        '/\bOWNERACCESS\b\s/i',
        '/\bNot\b\s/i',
        '/\bPAD\b\s/i',
        '/\bNTEXT\b\s/i',
        '/\bPARAMETERS\b\s/i',
        '/\bNULL\b\s/i',
        '/\bPARTIAL\b\s/i',
        '/\bNUMBER\b\s/i',
        '/\bDOUBLE\b\s/i',
        '/\bPASSWORD\b\s/i',
        '/\bNUMERIC\b\s/i',
        '/\bDECIMAL\b\s/i',
        '/\bPERCENT\b\s/i',
        '/\bNVARCHAR\b\s/i',
        '/\bPIVOT\b\s/i',
        '/\bOCTET_LENGTH\b\s/i',
        '/\bPOSITION\b\s/i',
        '/\bOLEOBJECT\b\s/i',
        '/\bLONGBINARY\b\s/i',
        '/\bPRECISION\b\s/i',
        '/\bON\b\s/i',
        '/\bPREPARE\b\s/i',
        '/\bOPEN\b\s/i',
        '/\bPRIMARY\b\s/i',
        '/\bOPTION\b\s/i',
        '/\bPRIVILEGES\b\s/i',
        '/\bOr\b\s/i',
        '/\bPROC\b\s/i',
        '/\bPROCEDURE\b\s/i',
        '/\bORDER\b\s/i',
        '/\bPUBLIC\b\s/i',
        '/\bREAL\b\s/i',
        '/\bSINGLE\b\s/i',
        '/\bSMALLDATETIME\b\s/i',
        '/\bREFERENCES\b\s/i',
        '/\bSMALLINT\b\s/i',
        '/\bSHORT\b\s/i',
        '/\bRESTRICT\b\s/i',
        '/\bSMALLMONEY\b\s/i',
        '/\bREVOKE\b\s/i',
        '/\bSOME\b\s/i',
        '/\bRIGHT\b\s/i',
        '/\bSPACE\b\s/i',
        '/\bROLLBACK\b\s/i',
        '/\bSQL\b\s/i',
        '/\bSCHEMA\b\s/i',
        '/\bSQLCODE\b\s/i',
        '/\bSQLERROR\b\s/i',
        '/\bSQLSTATE\b\s/i',
        '/\bSECOND\b\s/i',
        '/\bStDev\b\s/i',
        '/\bSELECT\b\s/i',
        '/\bStDevP\b\s/i',
        '/\bSELECTSCHEMA\b\s/i',
        '/\bSTRING\b\s/i',
        '/\bTEXT\b\s/i',
        '/\bSELECTSECURITY\b\s/i',
        '/\bSUBSTRING\b\s/i',
        '/\bSET\b\s/i',
        '/\bSum\b\s/i',
        '/\bSHORT\b\s/i',
        '/\bSYSNAME\b\s/i',
        '/\bSINGLE\b\s/i',
        '/\bSYSTEM_USER\b\s/i',
        '/\bSIZE\b\s/i',
        '/\bTABLE\b\s/i',
        '/\bUPDATEOWNER\b\s/i',
        '/\bTableID*\b\s/i',
        '/\bUPDATESECURITY\b\s/i',
        '/\bTEMPORARY\b\s/i',
        '/\bUPPER\b\s/i',
        '/\bTEXT\b\s/i',
        '/\bUSAGE\b\s/i',
        '/\bTIME\b\s/i',
        '/\bDATETIME\b\s/i',
        '/\bUSER\b\s/i',
        '/\bTIMESTAMP\b\s/i',
        '/\bUSING\b\s/i',
        '/\bTIMEZONE_HOUR\b\s/i',
        '/\bVALUE\b\s/i',
        '/\bTIMEZONE_MINUTE\b\s/i',
        '/\bVALUES\b\s/i',
        '/\bTINYINT\b\s/i',
        '/\bVar\b\s/i',
        '/\bTO\b\s/i',
        '/\bVARBINARY\b\s/i',
        '/\bBINARY\b\s/i',
        '/\bTOP\b\s/i',
        '/\bVARCHAR\b\s/i',
        '/\bTEXT\b\s/i',
        '/\bTRAILING\b\s/i',
        '/\bVarP\b\s/i',
        '/\bTRANSACTION\b\s/i',
        '/\bVARYING\b\s/i',
        '/\bTRANSFORM\b\s/i',
        '/\bVIEW\b\s/i',
        '/\bTRANSLATE\b\s/i',
        '/\bWHEN\b\s/i',
        '/\bTRANSLATION\b\s/i',
        '/\bWHENEVER\b\s/i',
        '/\bTRIM\b\s/i',
        '/\bWHERE\b\s/i',
        '/\bTRUE\b\s/i',
        '/\bWITH\b\s/i',
        '/\bUNION\b\s/i',
        '/\bWORK\b\s/i',
        '/\bUNIQUE\b\s/i',
        '/\bXor\b\s/i',
        '/\bUNIQUEIDENTIFIER\b\s/i',
        '/\bYEAR\b\s/i',
        '/\bUNKNOWN\b\s/i',
        '/\bYESNO\b\s/i',
        '/\bBIT\b\s/i',
        '/\bUPDATE\b\s/i',
        '/\bZONE\b\s/i',
        '/\bUPDATEIDENTITY\b\s/i',
        '/\bLIMIT\b\s/i',
        '/\b\x00\b\s/i',
        '/\b\x1a\b\s/i',
        '/["\']+/'

    );

    foreach ($palabras_reservadas as $palabra) {
        $cadena = preg_replace($palabra, '', $cadena);
    }
    return $cadena;
}

function validar_string($string, $permitidos)
{
    $string = trim($string);
    if (strlen($string) == 0) {
        return false; // La cadena solo contiene espacios en blanco
    }
    for ($i = 0; $i < strlen($string); $i++) {
        if (strpos($permitidos, $string[$i]) === false) {
            return false;
        }
    }
    return true;
}

function validar_int($valor)
{
    if (is_int($valor) || ctype_digit($valor)) {
        return true;
    } else {
        return false;
    }
}

function validar_correo($correo)
{
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        // Si el correo electrónico no es válido, retornamos false.
        return false;
    } else {
        // Si el correo electrónico es válido, retornamos true.
        return true;
    }
}
function validar_Monto($amount)
{
    // formato 0.00
    $options = array(
        'options' => array(
            'regexp' => '/^\d+(\.\d{1,2})?$/'
        )
    );

    // permitir puntos como separador decimal
    $amount = str_replace(',', '.', $amount);

    if (filter_var($amount, FILTER_VALIDATE_REGEXP, $options)) {
        return true;
    } else {
        return false;
    }
}

function validar_fecha($date, $format = 'Y-m-d')
{
    $dateObj = DateTime::createFromFormat($format, $date);
    return ($dateObj && $dateObj->format($format) === $date);
}

function generarToken()
{
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $longitud = strlen($caracteres);
    $token = '';
    for ($i = 0; $i < 10; $i++) {
        $token .= $caracteres[rand(0, $longitud - 1)];
    }
    return $token;
}

function comprobar_session()
{
    session_name("ecomercer_admin_data");
    session_start();

    if (isset($_SESSION['Usuario'])) {
        return  true;
    } else {
        return  false;
    }
}


//[abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$& ] caracteres permitidos para la clave admin
//[abcdefghijklmnopqrstuvwxyzñÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789 ,.?!] caracteres permitidos para texto
//[abcdefghijklmnopqrstuvwxyzñÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789 !,.-_*]  Caracteres permitidos para los mensaje que llevara el ticket
//[+0123456789'] Caracteres Permitidos para los input que tengan numerode telefono