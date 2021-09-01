$(function() {
    $( "#ResponderFeedback" ).jqxWindow({
        autoOpen: false,
        height: 700,
        width: 650,
        theme: 'energyblue',
        animationType: 'fade',
        showAnimationDuration: 500,
        closeAnimationDuration: 500,
        title: 'Responder Feedback',
        isModal: true
    });
    $( "#GridFeedback" ).jqxWindow({
        autoOpen: false,
        height: 700,
        width: 650,
        theme: 'energyblue',
        animationType: 'fade',
        showAnimationDuration: 500,
        closeAnimationDuration: 500,
        title: 'Lista de Feedback',
        isModal: true
    });  
    $( "#dialogInformacao" ).jqxWindow({
        autoOpen: false,
        height: 150,
        width: 450,
        theme: 'energyblue',
        animationType: 'fade',
        showAnimationDuration: 500,
        closeAnimationDuration: 500,
        title: 'Mensagem',
        isModal: true
    });       
});