var munkireportinfoVersion = function(col, row){    
    var cell = $('td:eq('+col+')', row),
        value = cell.text()
    cell.text(mr.integerToVersion(value))
}