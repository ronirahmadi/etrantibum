function ExportPdf() {  
    var doc = new jsPDF('l', 'pt', 'letter');  
    var htmlstring = '';  
    var tempVarToCheckPageHeight = 0;  
    var pageHeight = 0;  
    pageHeight = doc.internal.pageSize.height;  
    specialElementHandlers = {  
        // element with id of "bypass" - jQuery style selector  
        '#bypassme': function(element, renderer) {  
            // true = "handled elsewhere, bypass text extraction"  
            return true  
        }  
    };  
    margins = {  
        top: 150,  
        bottom: 60,  
        left: 40,  
        right: 40,  
        width: 600  
    };  
    var y = 20;  
    doc.setLineWidth(2);  
    doc.text(200, y = y + 20, "Laporan Data Tiket IndomaExpo");  
    doc.autoTable({  
        html: '#table-1',  
        startY: 70,  
        theme: 'grid', 
         columns: 
         [
          {header: 'No', dataKey: 'No'},
          {header: 'Nama', dataKey: 'Nama'},
          {header: 'Telepon', dataKey: 'Telepon'},
          {header: 'Alamat', dataKey: 'Alamat'},
          {header: 'Tanggal Kunjungan', dataKey: 'Tanggal Kunjungan'},
          {header: 'Status Tiket', dataKey: 'Status Tiket'},
          {header: 'Kode Tiket', dataKey: 'Kode Tiket'},
          {header: 'Waktu Scan', dataKey: 'Waktu Scan'},
        ], 
        columnStyles: {  
            0: {  
                cellWidth: 30,  
            },  
        },  
        styles: {  
            minCellHeight: 40  
        }  
    })  
    var currentDate = new Date();
    var tanggal = currentDate.toISOString().split('T')[0];

    var nama_file = 'Laporan Data Tiket IndomaExpo ' + tanggal + '.pdf';

    doc.save(nama_file);
}  