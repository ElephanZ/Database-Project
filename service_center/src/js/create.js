var addTrouble = () => {
    let div = "<div class='form-row' id='troubleDiv'>";
    div += "<div class='form-group col-md-5'>";
    div += "<label for='trouble'>Trouble</label>";
    div += "<input type='text' class='form-control' id='trouble' name='trouble[]' minlength='5' maxlength='255' required>";
    div += "<div class='invalid-feedback'> Required field. </div> </div>";
    div += "<div class='form-group col-md-5'>";
    div += "<label for='note'>Note</label>";
    div += "<input type='text' class='form-control' id='note' name='note[]' placeholder='...'>";
    div += "</div>";
    div += "<div class='form-group col-md-2'>";
    div += "<button type='button' class='btn btn-info' onclick='addTrouble()'> <i class='fa-solid fa-plus'></i> </button>";
    div += "<button type='button' class='btn btn-danger' onclick='$(this).parent().parent().remove()'> <i class='fa-solid fa-minus'></i> </button>";
    div += "</div> </div>";

    $('#troubleDiv').after(div);
};  

var addAccessory = () => {
    let div = "<div class='form-row' id='accessoryDiv'>";
    div += "<div class='form-group col-md-4'>";
    div += "<label for='accessname'>Accessory Name</label>";
    div += "<input type='text' class='form-control' id='accessname' name='accessname[]' placeholder='...'>";
    div += "</div>";
    div += "<div class='form-group col-md-4'>";
    div += "<label for='accessdescr'>Accessory Description</label>";
    div += "<input type='text' class='form-control' id='accessdescr' name='accessdescr[]' placeholder='...'>";
    div += "</div>";
    div += "<div class='form-group col-md-3'>";
    div += "<button type='button' class='btn btn-info' onclick='addAccessory()'> <i class='fa-solid fa-plus'></i> </button>";
    div += "<button type='button' class='btn btn-danger' onclick='$(this).parent().parent().remove()'> <i class='fa-solid fa-minus'></i> </button>";
    div += "</div> </div>";

    $('#accessoryDiv').after(div);
};  

var addContact = () => {
    let div = "<div class='form-row' id='contactDiv'>";
    div += "<div class='form-group col-md-3'>";
    div += "<label for='type'>Contact: Type</label>";
    div += "<select id='type' name='type[]' class='form-control' required>";
    div += "<option value='' disabled selected>Choose ...</option><option value='email'>Email</option><option value='numero'>Phone Number</option>";
    div += "</select>";
    div += "<div class='invalid-feedback'> Required field. </div> </div>";
    div += "<div class='form-group col-md-3'>";
    div += "<label for='value'>Contact: Value</label>";
    div += "<input type='text' class='form-control' id='value' name='value[]' minlength='8' maxlength='320' required>";
    div += "<div class='invalid-feedback'> Required field. </div> </div>";
    div += "<div class='form-group col-md-2'>";
    div += "<button type='button' class='btn btn-info' onclick='addContact()'> <i class='fa-solid fa-plus'></i> </button>";
    div += "<button type='button' class='btn btn-danger' onclick='$(this).parent().parent().remove()'> <i class='fa-solid fa-minus'></i> </button>";
    div += "</div> </div>";

    $('#contactDiv').after(div);
}; 