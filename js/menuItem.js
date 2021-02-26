// JavaScript Document

JQ = jQuery.noConflict();
function menuInit() {
	
    // Find the select box, named differently on the update and add forms
    var sel = JQ('select[name="Type"]');
    if (sel.attr('id') == undefined) {
        sel = JQ('#DataObjectManager_Popup_AddForm_TypeID');
    }
	if (sel.attr('id') == undefined) {
        sel = JQ('#DataObjectManager_Popup_DetailForm_Type');
    }
    // hide either the internal or external link editing box
    if (sel.val() == 'Headline' || sel.val() == 'SingleRow' || sel.val() == 'TextArea') {
        JQ('#Quantity').hide();
		JQ('#Price').hide();
		JQ('#SecondRow').hide();
		JQ('#ThirdRow').hide();
    }else if (sel.val() == 'SubHeadline') {
        JQ('#Quantity').hide();
		JQ('#Price').hide();
		JQ('#SecondRow').hide();
		JQ('#ThirdRow').hide();
	}else if (sel.val() == 'FoodMultiplePrices') {
        JQ('#Quantity').hide();

	}else if (sel.val() == 'SubSubHeadline') {
        JQ('#Quantity').hide();
		JQ('#Price').hide();
		JQ('#SecondRow').hide();
			Q('#ThirdRow').hide();
    
    } else if (sel.val() == 'Food' || sel.val() == 'ChoiceOfSide') {
		JQ('#Quantity').hide();	
		JQ('#SecondRow').show();
		JQ('#ThirdRow').hide();	
	} else if (sel.val() == 'Drink') {
		JQ('#SecondRow').show();
		JQ('#ThirdRow').show();	
	} else if (sel.val() == 'Wine') {
		JQ('#SecondRow').show();
		JQ('#ThirdRow').show();	
	} else if (sel.val() == 'SpecialOffer') {
		JQ('#Quantity').hide();		
	}else {
        JQ('.autocomplete_holder').toggle();
    };
    // toggle boxes on drop down change
    sel.change(function(e) {
		if(sel.val()=="Food" || sel.val() == 'ChoiceOfSide'){
			JQ('#Quantity').hide();
			JQ('#SecondRow').show();
			JQ('#ThirdRow').hide();
			JQ('#Price').show();
		}else if (sel.val() == 'FoodMultiplePrices') {
       	 	JQ('#Quantity').hide();
			JQ('#SecondRow').show();
			JQ('#ThirdRow').show();
			JQ('#Price').show();
		}else if(sel.val()=="Drink"){
			JQ('#SecondRow').show();
			JQ('#ThirdRow').show();
			JQ('#Quantity').show();
			JQ('#Price').show();
		}else if(sel.val()=="Wine"){
			JQ('#SecondRow').show();
			JQ('#ThirdRow').show();
			JQ('#Quantity').show();
			JQ('#Price').show();
		}else if(sel.val()=="SpecialOffer"){
			JQ('#SecondRow').show();
			JQ('#ThirdRow').show();
			JQ('#Quantity').hide();
			JQ('#Price').show();
		}else{
			JQ('#SecondRow').hide();
			JQ('#ThirdRow').hide();
			JQ('#Quantity').hide();
			JQ('#Price').hide();
		}
        
        JQ('.autocomplete_holder').toggle();
    });
}