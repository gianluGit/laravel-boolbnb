require('./bootstrap');
window.$ = require('jquery');

// Ricerca al click e tasto invio
function keyupInput() {

   var inputCerca = $("#searchbar");
   inputCerca.keyup(sendKeyupInput);

 }
 function sendKeyupInput(event) {

   var tasto = event.which;
   var input = $ (this).val();
   if (tasto == 13 && input.length > 0) {
     $("searchbtn").click();

   }
 }
// ------ fine funzioni ricerca al click
// --- inizio funzioni per filtraggio risultati
// listener che al change sulla checkbox  fa partire un if per cui finchè una checkbox è selezionata filtra i risultati in base ai filtri. Altrimenti ritorna tutti i risultati.
function filterListener() {

  var filters = [];
  var cards = $('.card');
  $('input[name="comfort"]').on('change', function (e) {
    e.preventDefault();
    filters = []; // reset
    if (($('#wifi').prop('checked') == true)
        || ($('#parking').prop('checked') == true)
        || ($('#pool').prop('checked') == true)
        || ($('#reception').prop('checked') == true)
        || ($('#sauna').prop('checked') == true)
        || ($('#seaview').prop('checked') == true)
        || ($('#massage').prop('checked') == true)
        || ($('#solarium').prop('checked') == true)
        || ($('#sport').prop('checked') == true)
        || ($('#golf').prop('checked') == true))
    {
      $('input[name="comfort"]:checked').each(function () {
        filters.push($(this).val()); // input name comfort
          cards.each(function () {
            for (var i = 0; i < filters.length; i++) {
              if ($(this).find('li.comforts').hasClass(filters[i])) { // il div card
                $(this).show();
              } else {
                $(this).hide();
                break // serve per non proseguire il for ed escludere subito il div senza la checkbox (cmf) richiesta
              }
            }
          })
      });
    } else {
      cards.show(); // se tutte le checkbox sono false, mostra tutte le cards coi results
    }
  });

}

function buttonActive() {
// nome del bottone
  var btn = $('#btnsearch');
  // classe comune alle due select
  var targetSel = $(".searchselect");
  // id select 1
  var minRoom = $("#minRoom");
  // id selecrt 2
  var minBed = $("#minBed");
  var radius = $("#radius");
  targetSel.change(function () {
      if (!(minRoom.val() == null) && !(minBed.val() == null) && !(radius.val() == null)) {
        btn.attr('disabled', false)
      }
      })
}

function messageToggle() {
    // mi prendo il li che racchiude il messaggio
    var messages = $(".message");
    // mi prendo  l'effettivo testo del msg
    var msgText = $(".messageTest");
    //frecce up/down
    var msgArrowD = $(".fa-arrow-down");
    var msgArrowU = $(".fa-arrow-up");
      // il testo dei msg parte di default nascosto
    msgText.hide();
    // scateno evento al click
    messages.click(function () {
      // su questo li messaggio, trova il suo testo e applica il toggle
      $(this).find(msgText).fadeToggle();
      $(this).find(msgArrowD).toggle(10);
      $(this).find(msgArrowU).toggle(10);
    });
}

// Placeholder user appartments list
function userAppPlaceholder() {
  var target = $('#user_appartments');
  if (target.children().length == 0) {
    target.html('<em>No Suites related to your Account!</em>');
  }
}

// Edit Button Listener
function editBtnListener() {
  var input = $('#editBtn');
  input.click(locationCutter);
}

// City and Address cutter
function locationCutter() {
  var city = $('#editCity').val();
  var street = $('#editStreet').val();

  var cutCity = city.split(', ')[0];

  var partStreet = street.split(', ');
  var nameStreet = partStreet[0];
  var possibleNum = partStreet[1];

  if(parseInt(partStreet[1])) {
    var defStreet = partStreet[0] + ', ' + partStreet[1];
  } else {
    var defStreet = partStreet[0];
  }

  city = $('#editCity').val(cutCity);
  street = $('#editStreet').val(defStreet);

}


// --- fine funzioni per filtraggio risultati
function init() {
  keyupInput();
  filterListener();
  buttonActive();
  messageToggle();
  userAppPlaceholder();
  editBtnListener();
}
$(document).ready(init)
