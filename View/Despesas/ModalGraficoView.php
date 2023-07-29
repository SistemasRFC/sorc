<script src="js/ModalGraficoView.js?<?php echo time();?>"></script>
<div class="modal fade bd-example-modal-lg" id="graficoDespesa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="graficoDespesaTitle">Gráfico por tipo de despesa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">         
                <div class="chart-area">
                    <canvas id="graficoTipoDespesa"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>