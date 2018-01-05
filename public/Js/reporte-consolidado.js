$(function() {
    $('.datatable').DataTable({ 
    	"language": {
        	"url": 'public/Spanish.json'
    	},
    	responsive:true, dom: 'Bfrtip',
        buttons: [
            'csv',
            'excel',
            'print',
            {
            	extend: 'pdf',
                orientation: 'landscape',
                pageSize: 'LEGAL'
            }
        ]
    });
});