// DATA_TEMPLATE: empty_table
oTest.fnStart( "oLanguage.sLengthmenu" );

$(document).ready( function () {
	/* Check the default */
	var oTable = $('#example').dataTable( {
		"sAjaxSource": "../../../examples/examples_support/json_source.txt"
	} );
	var oSettings = oTable.fnSettings();
	
	oTest.fnWaitTest( 
		"menu language is 'Show _menu_ entries' by default",
		null,
		function () { return oSettings.oLanguage.sLengthmenu == "Show _menu_ entries"; }
	);
	
	oTest.fnTest(
		"_menu_ macro is replaced by select menu in DOM",
		null,
		function () { return $('select', oSettings.aanFeatures.l[0]).length == 1 }
	);
	
	oTest.fnTest(
		"Default is put into DOM",
		null,
		function () {
			var anChildren = oSettings.aanFeatures.l[0].childNodes;
			var bReturn =
				anChildren[0].nodeValue == "Show " &&
				anChildren[2].nodeValue == " entries";
			return bReturn;
		}
	);
	
	
	oTest.fnWaitTest( 
		"menu length language can be defined - no _menu_ macro",
		function () {
			oSession.fnRestore();
			oTable = $('#example').dataTable( {
				"sAjaxSource": "../../../examples/examples_support/json_source.txt",
				"oLanguage": {
					"sLengthmenu": "unit test"
				}
			} );
			oSettings = oTable.fnSettings();
		},
		function () { return oSettings.oLanguage.sLengthmenu == "unit test"; }
	);
	
	oTest.fnTest( 
		"menu length language definition is in the DOM",
		null,
		function () {
			var anChildren = oSettings.aanFeatures.l[0].childNodes;
			return anChildren[0].nodeValue == "unit test";
		}
	);
	
	
	oTest.fnWaitTest( 
		"menu length language can be defined - with _menu_ macro",
		function () {
			oSession.fnRestore();
			oTable = $('#example').dataTable( {
				"sAjaxSource": "../../../examples/examples_support/json_source.txt",
				"oLanguage": {
					"sLengthmenu": "unit _menu_ test"
				}
			} );
			oSettings = oTable.fnSettings();
		},
		function () {
			var anChildren = oSettings.aanFeatures.l[0].childNodes;
			var bReturn =
				anChildren[0].nodeValue == "unit " &&
				anChildren[2].nodeValue == " test";
			return bReturn;
		}
	);
	
	
	oTest.fnWaitTest( 
		"Only the _menu_ macro",
		function () {
			oSession.fnRestore();
			oTable = $('#example').dataTable( {
				"sAjaxSource": "../../../examples/examples_support/json_source.txt",
				"oLanguage": {
					"sLengthmenu": "_menu_"
				}
			} );
			oSettings = oTable.fnSettings();
		},
		function () {
			var anChildren = oSettings.aanFeatures.l[0].childNodes;
			var bReturn =
				anChildren.length == 1 &&
				$('select', oSettings.aanFeatures.l[0]).length == 1;
			return bReturn;
		}
	);
	
	
	oTest.fnComplete();
} );