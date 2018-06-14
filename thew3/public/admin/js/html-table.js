var DatatableHtmlTableDemo = function() {
	var e = function() {
		var e = $(".m-datatable").mDatatable({
			data: {                
                pageSize: 50,
                saveState: {
                    cookie: true,
                    webstorage: true
                },
                serverPaging: true,
                serverFiltering: true,
                serverSorting: true
            }, layout: {
                theme: 'default',
                class: '',
                scroll: true,
                footer: false
            },
			sortable: true,
            filterable: false,
            pagination: true,
			columns: [{
                field: "No.",
                title: "No.",            
                width: 40
            }, {
                field: "Name",
                title: "Name",
				
      
            }, {
                field: "Email",
                title: "Email",                
            }, {
                field: "Mobile No.",
                title: "Mobile No.",
				width: 100
            }, {
                field: "Role",
                title: "Role",
				width: 100
            }, {
                field: "Action",
                title: "Action",
				width: 50
            }]
		}),
		a = e.getDataSourceQuery();
		$("#m_form_search").on("keyup", function(a) {
			e.search($(this).val().toLowerCase())
		}).val(a.generalSearch)
	};
	return {
	  init: function() {
	   e()
	  }
	}
}();
jQuery(document).ready(function() {
	DatatableHtmlTableDemo.init()
});