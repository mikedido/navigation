/*
 * Function js 
 *
 * @author Mahdi Gueffaz
*/

var _counter = 1;

/**
 * Function to add fieldset
 *
*/
function Add() {
    _counter++;
    var oClone = document.getElementById("template").cloneNode(true);
    oClone.id += (_counter + "");
    document.getElementById("placeholder").appendChild(oClone);
    //console.log(oClone);
    //set the ids
    putBranchDistanceId(document.getElementsByClassName('inputDistance'));
    putBranchDirectionId(document.getElementsByClassName('inputDirection'));
}

/**
 * Function to delete filedset
 *
*/
function Delete() {
	var id = "template"+_counter;
	//console.log(document.getElementById(id));
	if (_counter != 1) {
		document.getElementById(id).remove();
		_counter -=1;
	}
}

/**
 *
 *
 *
 *
*/
function putBranchDistanceId($elements) {

	var $i = 0;
	for ($i = 0; $i < $elements.length; $i++){
		console.log($elements[$i]);
		$elements[$i].id = 'brancheDistance'+$i;
		$elements[$i].name = 'brancheDistance'+$i;
	}
}

function putBranchDirectionId($elements){

	var $i = 0;
	for ($i = 0; $i < $elements.length; $i++){
		console.log($elements[$i]);
		$elements[$i].id = 'brancheDirection'+$i;
		$elements[$i].name = 'brancheDirection'+$i;
	}
}

/**
 * Function to check form
 *
*/
function formCheck() {

}

$(document).ready(function() {
    $('#formNav').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            forceVent: {
                validators: {
                    notEmpty: {
                        message: ''
                    }
                }
            },
            directionVent: {
                validators: {
                    notEmpty: {
                        message: "Please enter a value between 0 à 359"
                    }
                }
            },
            brancheDistance: {
            	validators: {
            		notEmpty: {
            			message: ""
            		}
            	}
            },
            brancheDirection: {
            	validators: {
            		notEmpty: {
            			message: "Please enter a value between 0 à 359"
            		}
            	}
            },
            vp: {
            	validators: {
            		notEmpty: {
            			message: ""
            		}
            	}
            }
        }
    });
});