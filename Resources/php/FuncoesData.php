<?php

class FuncoesData{
    /**
     * Converte a data que vem do banco para ser visualizada no form
     * @param <type> $data
     * @return <type>
     */
    Public Static function ConverteDataBanco($data, $hora = false) {
        $dataReturn='';
        if ($data!=''){
            $dataReturn = substr($data, 8, 2) . '/' . substr($data, 5, 2) . '/' . substr($data, 0, 4);
            if ($hora) {
                $dataReturn = $dataReturn . " " . substr($data, 11, 8);
            }
        }
        return $dataReturn;
    }

    /**
     * Retorna, em dias, a diferença entre duas datas
     * @param type $CheckIn
     * @param type $CheckOut
     * @return type
     */
    Public Function diffDate($CheckIn, $CheckOut) {
        $CheckInX = explode("-", $CheckIn);
        $CheckOutX = explode("-", $CheckOut);
        $date1 = mktime(0, 0, 0, $CheckInX[1], $CheckInX[2], $CheckInX[0]);
        $date2 = mktime(0, 0, 0, $CheckOutX[1], $CheckOutX[2], $CheckOutX[0]);
        $interval = ($date2 - $date1) / (3600 * 24);
        return $interval;
    }

    /**
     * Atualiza o campo data passado como par�metro dentro de um array
     * @param Array $lista
     * @param Date $campo
     * @return String
     */
    Public Static Function AtualizaDataInArray($lista, $campo, $hora = false) {
        $listaAtualizada = $lista;
        $datas = explode('|', $campo);
        for ($i = 0; $i < count($listaAtualizada[1]); $i++) {
            for ($j = 0; $j < count($datas); $j++) {
                $listaAtualizada[1][$i][$datas[$j]] = self::ConverteDataBanco($listaAtualizada[1][$i][$datas[$j]], $hora);
            }
        }
        return $listaAtualizada;
    }

    /**
     * Adiciona dias, meses ou anos em uma data
     * @param type $date
     * @param type $days
     * @param type $mounths
     * @param type $years
     * @return type
     */
    Public static Function makeDate($date, $days = 0, $mounths = 0, $years = 0) {
        $date = explode("/", $date);
        return date('d/m/Y', mktime(0, 0, 0, $date[1] + $mounths, $date[0] + $days, $date[2] + $years));
    }

    /**
     * Retorna um array de datas de acordo com o dia da semana, mês e ano passado
     * por parâmetro
     * Ex: Todas as datas que são segunda feira no mês 11 de 20XX.
     * @param type $dia_semana
     * @param type $mes
     * @param type $ano
     * @return type
     */
    Public Function dias($dia_semana, $mes, $ano) {
        $Date = new DateTime();
        $dias = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);
        for ($dia = 1; $dia <= $dias; $dia++) {
            $Date->setDate($ano, $mes, $dia);
            if ($Date->format("w") == $dia_semana) {
                $datas[] = $this->makeDate($dia . "/" . $mes . "/" . $ano);
            }
        }
        return $datas;
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

    Public Function AddDiasData($dtaPagamento,
                                $qtdDias){
        $quebrarDatas = explode("/", $dtaPagamento);
        list($dia, $mes, $ano) = $quebrarDatas;
        $dataNova = date('d/m/Y', mktime(0,0,0, $mes, $dia + $qtdDias, $ano));
        return $dataNova;
    }
}