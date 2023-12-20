        function ExportExcel(exceptColumn) {
            console.time('excel 3 download time');
            // Create WorkBook
            var wb = XLSX.utils.book_new();
            // Define Option
            var opt = {
                // new row except table element
                rowIndex: 1,
                // if you want excpet column use this option, use Array [0,1,2 ... ]
                exceptColumn: [9],
                // merge option ( if you have to merge new row )
                merges: [{
                    // start
                    s: {
                        c: 0, // col
                        r: 0	// row
                    },
                    // end
                    e: {
                        c: $("#table-1").find("th").length - 1 - [6].length, // col ( this means : merge as table column counts )
                        r: 0 // row
                    }
                }],
            };
            // WorkSheet
            var ws = XLSX2.utils.table_to_sheet(document.getElementById('table-1'), opt);
            // new row --> Title
            ws["A1"] = {
                t: "s",
                v: "Laporan Data Tiket IndomaExpo"
            };
            // new row --> style
            ws["A1"].s = {
                font: {
                    name: "arial",
                    bold: true,
                },
                alignment: {
                    vertical: "center",
                    horizontal: "center",
                    wrapText: '1', // any truthy value here
                },
                border: {
                    right: {
                        style: "thin",
                        color: "000000"
                    },
                    left: {
                        style: "thin",
                        color: "000000"
                    },
                    top: {
                        style: "thin",
                        color: "000000"
                    },
                },
            };
            // cell style
            for (i in ws) {
                if (typeof (ws[i]) != "object") continue;
                let cell = XLSX.utils.decode_cell(i);
                // cell style
                ws[i].s = {
                    font: {
                        name: "arial"
                    },
                    alignment: {
                        vertical: "center",
                        horizontal: "center",
                        wrapText: '1',
                    },
                    border: {
                        right: {
                            style: "thin",
                            color: "000000"
                        },
                        left: {
                            style: "thin",
                            color: "000000"
                        },
                        top: {
                            style: "thin",
                            color: "000000"
                        },
                        bottom: {
                            style: "thin",
                            color: "000000"
                        },
                    },
                };
                // new row & first row ( table th ) style
                if (cell.r == 0 || cell.r == 1) {
                    ws[i].s.fill = {
                        patternType: "solid",
                        fgColor: {
                            rgb: "FFFF00"
                        },
                        bgColor: {
                            rgb: "FFFF00"
                        }
                    };
                }
                // if you merge other rows use this
                /* if ( i == "!merges" ) {
                    ws[ "!merges" ].push( {
                        s : {
                            c : 0 ,
                            r : 0
                        } ,
                        e : {
                            c : 0 ,
                            r : 0
                        }
                    } );
                } */
            }
            // Sheet Append With Title
            XLSX.utils.book_append_sheet(wb, ws, 'sheet title');

            //width of table
            ws['!cols'] = [{width: 8}, {width: 20}, {width: 20}, {width: 50}, {width: 20}, {width: 25}, {width: 20}, {width: 40}];
            
            // Create Excel File With File Name
            XLSX.writeFile(wb, ('Laporan Data Tiket IndomaExpo.xlsx'));
            console.timeEnd('excel 3 download time');
        }