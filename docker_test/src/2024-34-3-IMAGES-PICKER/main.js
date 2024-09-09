// htmx.config.defaultSwapStyle = "outerHTML";
// Tässä esimerkki HTMX oletusarvojen konfiguroinnista
console.log(htmx);


function showConfirmationModal(event){

    // Jos path on suggested-images, lopetetaan suoritus (ei tehdä mitään)
    if(event.detail.path === 'suggested-images.php'){
        return; // Lopettaa koko function suorituksen
    }

    console.log("Confirmation");

    // Estetään eventin toiminta
    event.preventDefault();
    console.log(event);

    // otetaan talteen, mikä on eventin action
    const action = event.detail.elt.dataset.action;

    // lisätään dialog/modal HTML koodi
    const confirmationModal = `
        <dialog class="modal">
            <div id="confirmation">
                <h2>Are you Sure?</h2>
                <p>Do you really want to ${action} this picture?</p>
                <div id="confirmation-actions">
                    <button id="action-no" class="button-text">No</button>
                    <button id="action-yes" class="button ${action}">Yes</button>
                </div>
            </div>
        </dialog>
    `;

    document.body.insertAdjacentHTML('beforeend', confirmationModal);
    const dialog = document.querySelector('dialog');

    const noBtn = document.getElementById('action-no');
    noBtn.addEventListener('click', function(){
        dialog.remove();
    });

    const yesBtn = document.getElementById('action-yes');
    yesBtn.addEventListener('click', function(){
        // jatketaan requestin suoritusta
        event.detail.issueRequest();

        dialog.remove();
    });


    dialog.showModal();

} //showConfirmationModal päättyy

document.addEventListener('htmx:confirm', showConfirmationModal);


document.getElementById('suggested-images').addEventListener('htmx:afterRequest', function(event){
    
    if(event.detail.pathInfo.requestPath !== 'suggested-images.php'){
        console.log(event.detail.pathInfo.requestPath)
        return; // Lopettaa koko function suorituksen   
    }else{
        console.log(event.detail.pathInfo.requestPath);
    }

    console.log("eventing");
    console.log(event);

    // resetoidaan palkin animaatio
    const loadingDiv = document.getElementById('loading');

    loadingDiv.style.animation = 'none';
    loadingDiv.offsetHeight; // activoi selaimessa CSS reflow:n, jolloin animaatio alkaa taas alusta
    loadingDiv.style.animation = null; // palauttaa oletus arvon elementille
});