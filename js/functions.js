var selectedtrim = 1;

$.fn.dataTable.ext.search.push(
    function (settings, data, dataIndex) {
        var table = $('#datos').DataTable();
        var cell = table.cell(dataIndex, 9).node();
        var consistency = parseFloat(table.cell(dataIndex, 12).node().innerText);
        var classname = cell.className;
        var value = parseInt(classname.replace('level', ''));

        var ci = parseFloat(document.getElementById('Consistency_Index').value);

        return (consistency >= ci) && (value > selectedtrim);
    }
);

//Filter for the Trim tool: Filters the data table according to the selected color (button).
function fun(value) {
    selectedtrim = value;
    $('#datos').DataTable().draw();
}
function show_valueS(x) {
    document.getElementById("CI").innerHTML = x;
    $('#datos').DataTable().draw();
}

function show_valueE(x) {
    document.getElementById("EC").innerHTML = x;
}
// Filter visualization options: allows filtering according to the selected criteria.
function hideColumns(sender) {
    var sel = sender.value;
    document.getElementById("fb").innerText = "FILTERED BY: " + sender.innerText;


    if (sel == 0) {
        for (var i = 1; i <= 6; i++) {
            $('.col_' + i).show();
        }
    } else {
        for (var i = 1; i <= 6; i++) {
            $('.col_' + i).hide();
        }
        $('.col_' + sel).show();
    }
}

var ling = ['Dreadful', 'Very Incorrect', 'Incorrect', 'Moderate', 'Correct', 'Very Correct', 'Excellent'];
$(document).ready(function () {
    var oTablaDatos = $('#datos').DataTable({
        "infoCallback": function (settings, start, end, max, total, pre) {
            return "Showing " + total + " entries"
                + ((total !== max) ? " (filtered from " + max + " total entries)" : "");
        },
        scrollResize: true,
        scrollY: 500,
        scrollX: 100,
        scrollCollapse: true,
        paging: false,
        searching: true,
        "columnDefs": [{
            "targets": [10],
            "visible": false,
            "searchable": false
        },
        {
            "targets": [11],
            "visible": false,
            "searchable": false
        },
        {
            "targets": [12],
            "visible": false,
            "searchable": false
        }
        ]
    });

    oTablaDatos.on('search.dt', function () {
        var t = $('#datos').DataTable();
        var rows = t.rows({ filter: 'applied' }).data();
        var rowCount = t.rows({ filter: 'applied' }).nodes().length;

        var total = 0;

        for (i = 0; i < rowCount; i++) {
            total = total + (((parseFloat(rows[i][10]) - 1) + parseFloat(rows[i][11])) * parseFloat(rows[i][6]));
        }

        total = total / rowCount;

        var label = Math.round(total);
        var final = label - total;

        if (rowCount) {
            if (document.getElementById('chkChangeLabels').checked) {
                document.getElementById('qt').innerText = 'QUESTIONNAIRE TOTAL SCORE = (' + ling[label] + ', ' + Number(final).toFixed(3) + ')';
            } else {
                document.getElementById('qt').innerHTML = 'QUESTIONNAIRE TOTAL SCORE = (s<sub>' + label + '</sub><sup>7</sup>, ' + Number(final).toFixed(3) + ')';
            }
        } else {
            document.getElementById('qt').innerHTML = 'QUESTIONNAIRE TOTAL SCORE = (s<sub>0</sub><sup>7</sup>, 0)';
        }

        var columns = [2, 3, 4, 5];
        var sums = { 2: 0, 3: 0, 4: 0, 5: 0 };

        for (j = 0; j < rowCount; j++) {
            for (i in columns) {
                var column = columns[i];
                var data = rows[j][column].replace('<sub>', '').replace('</sub>', '').replace('<sup>', '').replace('</sup>', '');
                var elements = data.split(',');
                var beta = 0;
                if (elements[0].length < 6) {
                    beta = parseInt(elements[0][2]);
                } else {
                    elements[0] = elements[0].replace('(', '');
                    beta = ling.indexOf(elements[0]);
                }
                sums[column] = sums[column] + ((beta + parseFloat(elements[1].replace(')', '')) * rows[j][6]));
            }
        }

        for (i in columns) {
            var column = columns[i];
            sums[column] = sums[column] / rowCount;
        }

        console.log(sums);
        var r, d;
        if (document.getElementById('chkChangeLabels').checked) {
            r = Math.round(sums[2]);
            d = Number(r - sums[2]).toFixed(3);
            document.getElementsByName('fcc')[1].innerText = '(' + ling[(isNaN(r) ? '0' : r)] + ', ' + (isNaN(d) ? '0' : d) + ')';
            r = Math.round(sums[3]);
            d = Number(r - sums[3]).toFixed(3);
            document.getElementsByName('fcw')[1].innerText = '(' + ling[(isNaN(r) ? '0' : r)] + ', ' + (isNaN(d) ? '0' : d) + ')';
            r = Math.round(sums[4]);
            d = Number(r - sums[4]).toFixed(3)
            document.getElementsByName('fcp')[1].innerText = '(' + ling[(isNaN(r) ? '0' : r)] + ', ' + (isNaN(d) ? '0' : d) + ')';
            r = Math.round(sums[5]);
            d = Number(r - sums[5]).toFixed(3);
            document.getElementsByName('fcas')[1].innerText = '(' + ling[(isNaN(r) ? '0' : r)] + ', ' + (isNaN(d) ? '0' : d) + ')';
        } else {
            r = Math.round(sums[2]);
            d = Number(r - sums[2]).toFixed(3);
            document.getElementsByName('fcc')[1].innerHTML = '(s<sub>' + (isNaN(r) ? '0' : r) + '</sub><sup>7</sup>, ' + (isNaN(d) ? '0' : d) + ')';
            r = Math.round(sums[3]);
            d = Number(r - sums[3]).toFixed(3);
            document.getElementsByName('fcw')[1].innerHTML = '(s<sub>' + (isNaN(r) ? '0' : r) + '</sub><sup>7</sup>, ' + (isNaN(d) ? '0' : d) + ')';
            r = Math.round(sums[4]);
            d = Number(r - sums[4]).toFixed(3)
            document.getElementsByName('fcp')[1].innerHTML = '(s<sub>' + (isNaN(r) ? '0' : r) + '</sub><sup>7</sup>, ' + (isNaN(d) ? '0' : d) + ')';
            r = Math.round(sums[5]);
            d = Number(r - sums[5]).toFixed(3);
            document.getElementsByName('fcas')[1].innerHTML = '(s<sub>' + (isNaN(r) ? '0' : r) + '</sub><sup>7</sup>, ' + (isNaN(d) ? '0' : d) + ')';
        }
    });

    oTablaDatos.draw();
});

function columnformat(asLinguistic) {
    var cols = [2, 3, 4, 5, 7];
    var rows = $('#tableDatosBody tr');
    var qt = document.getElementById('qt');
    var c = qt.innerText.split(',');
    var j, column, s, item;
    if (asLinguistic) {
        j = c[0][30];
        qt.innerText = 'QUESTIONNAIRE TOTAL SCORE = (' + ling[j] + ', ' + c[1];

        for (i = 0; i < rows.length; i++) {
            for (col in cols) {
                column = rows[i].cells[cols[col]];
                s = column.innerText.split(',');
                j = column.innerText[2];
                column.innerText = '(' + ling[j] + ', ' + s[1];
            }
        }
    } else {
        item = c[0].split('(')[1];
        qt.innerHTML = 'QUESTIONNAIRE TOTAL SCORE = (s<sub>' + ling.indexOf(item) + '</sub><sup>7</sup>, ' + c[1];

        for (i = 0; i < rows.length; i++) {
            for (col in cols) {
                column = rows[i].cells[cols[col]];
                s = column.innerText.split(',');
                item = s[0].replace('(', '');
                column.innerHTML = '(s<sub>' + ling.indexOf(item) + '</sub><sup>7</sup>, ' + s[1];
            }
        }
    }

    $('#datos').DataTable().draw();
}