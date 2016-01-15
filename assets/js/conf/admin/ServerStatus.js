$(document).ready(function()
{
  $.ajax({
        dataType: "json",
        url: "../ServerStatus/xml.php?plugin=complete&json",
        success: function (data) {

            $("#Hostname").text(data["Vitals"]["@attributes"]["Hostname"]);
            $("#Kernel").text(data["Vitals"]["@attributes"]["Kernel"]);
            $("#ListeningIP").text(data["Vitals"]["@attributes"]["IPAddr"]);
            $("#Uptime").text(formatUptime(data["Vitals"]["@attributes"]["Uptime"]));


            $("#Memory").append("<td>Physical Memory</td><td>"+data["Memory"]["@attributes"]["Percent"]+"%</td><td>"+formatBytes(data["Memory"]["@attributes"]["Free"], 'gib')+"</td><td>"+formatBytes(data["Memory"]["@attributes"]["Used"], 'gib')+"</td><td>"+formatBytes(data["Memory"]["@attributes"]["Total"], 'gib')+"</td>");
            $("#Swap").append("<td>Swap</td><td>"+data["Memory"]["Swap"]["@attributes"]["Percent"]+"%</td><td>"+formatBytes(data["Memory"]["Swap"]["@attributes"]["Free"], 'gib')+"</td><td>"+formatBytes(data["Memory"]["Swap"]["@attributes"]["Used"], 'gib')+"</td><td>"+formatBytes(data["Memory"]["Swap"]["@attributes"]["Total"], 'gib')+"</td>");
           
            var html = "";
            for (var i = 0; i < data["Network"]["NetDevice"].length; i++) 
            {
                html +="<tr>"
                    html +="<td>"+data["Network"]["NetDevice"][i]["@attributes"]["Name"]+"</td>"
                    html +="<td>"+formatBytes(data["Network"]["NetDevice"][i]["@attributes"]["RxBytes"], 'mib')+"</td>"
                    html +="<td>"+formatBytes(data["Network"]["NetDevice"][i]["@attributes"]["TxBytes"], 'mib')+"</td>"
                    html +="<td>"+data["Network"]["NetDevice"][i]["@attributes"]["Err"]+"</td>"
                    html +="<td>"+data["Network"]["NetDevice"][i]["@attributes"]["Drops"]+"</td>"
                html +="</tr>"
            };
               

            $("#Network").append(html);


            var html = "";
            for (var i = 0; i < data["FileSystem"]["Mount"].length; i++) 
            {
                if(data["FileSystem"]["Mount"][i]["@attributes"]["Name"]!='Compact Disc')
                {
                    html +="<tr>"
                        html +="<td>"+data["FileSystem"]["Mount"][i]["@attributes"]["MountPoint"]+"</td>"
                        html +="<td>"+data["FileSystem"]["Mount"][i]["@attributes"]["Name"]+"</td>"
                        html +="<td>"+data["FileSystem"]["Mount"][i]["@attributes"]["Percent"]+"%</td>"
                        html +="<td>"+formatBytes(data["FileSystem"]["Mount"][i]["@attributes"]["Free"], 'gib')+"</td>"
                        html +="<td>"+formatBytes(data["FileSystem"]["Mount"][i]["@attributes"]["Used"], 'gib')+"</td>"
                        html +="<td>"+formatBytes(data["FileSystem"]["Mount"][i]["@attributes"]["Total"], 'gib')+"</td>"

                    html +="</tr>"
                }
            };

            $("#Disk").append(html);

        }
    });
});

/**
 * format seconds to a better readable statement with days, hours and minutes
 * @param {Number} sec seconds that should be formatted
 * @return {String} html string with no breaking spaces and translation statemen
*/
function formatUptime(sec) {
    var txt = "", intMin = 0, intHours = 0, intDays = 0;
    intMin = sec / 60;
    intHours = intMin / 60;
    intDays = Math.floor(intHours / 24);
    intHours = Math.floor(intHours - (intDays * 24));
    intMin = Math.floor(intMin - (intDays * 60 * 24) - (intHours * 60));
    if (intDays) {
        txt += intDays.toString() + String.fromCharCode(160) + "days" + String.fromCharCode(160);
    }
    if (intHours) {
        txt += intHours.toString() + String.fromCharCode(160) + "hours" + String.fromCharCode(160);
    }
    return txt + intMin.toString() + String.fromCharCode(160) + "minutes";
}

/**
 * format the byte values into a user friendly value with the corespondenting unit expression<br>support is included
 * for binary and decimal output<br>user can specify a constant format for all byte outputs or the output is formated
 * automatically so that every value can be read in a user friendly way
 * @param {Number} bytes value that should be converted in the corespondenting format, which is specified in the phpsysinfo.ini
 * @param {jQuery} xml phpSysInfo-XML
 * @return {String} string of the converted bytes with the translated unit expression
 */
function formatBytes(bytes, byteFormat) {
    var show = "";

    if (byteFormat === undefined) {
        byteFormat = "auto_binary";
    }

    switch (byteFormat.toLowerCase()) {
    case "pib":
        show += round(bytes / Math.pow(1024, 5), 2);
        show += String.fromCharCode(160) + "PiB";
        break;
    case "tib":
        show += round(bytes / Math.pow(1024, 4), 2);
        show += String.fromCharCode(160) + "TiB";
        break;
    case "gib":
        show += round(bytes / Math.pow(1024, 3), 2);
        show += String.fromCharCode(160) + "GiB";
        break;
    case "mib":
        show += round(bytes / Math.pow(1024, 2), 2);
        show += String.fromCharCode(160) + "MiB";
        break;
    case "kib":
        show += round(bytes / Math.pow(1024, 1), 2);
        show += String.fromCharCode(160) + "KiB";
        break;
    case "pb":
        show += round(bytes / Math.pow(1000, 5), 2);
        show += String.fromCharCode(160) + "PB";
        break;
    case "tb":
        show += round(bytes / Math.pow(1000, 4), 2);
        show += String.fromCharCode(160) + "TB";
        break;
    case "gb":
        show += round(bytes / Math.pow(1000, 3), 2);
        show += String.fromCharCode(160) + "GB";
        break;
    case "mb":
        show += round(bytes / Math.pow(1000, 2), 2);
        show += String.fromCharCode(160) + "MB";
        break;
    case "kb":
        show += round(bytes / Math.pow(1000, 1), 2);
        show += String.fromCharCode(160) + "KB";
        break;
    case "b":
        show += bytes;
        show += String.fromCharCode(160) + "B";
        break;
    case "auto_decimal":
        if (bytes > Math.pow(1000, 5)) {
            show += round(bytes / Math.pow(1000, 5), 2);
            show += String.fromCharCode(160) + "PB";
        }
        else {
            if (bytes > Math.pow(1000, 4)) {
                show += round(bytes / Math.pow(1000, 4), 2);
                show += String.fromCharCode(160) + "TB";
            }
            else {
                if (bytes > Math.pow(1000, 3)) {
                    show += round(bytes / Math.pow(1000, 3), 2);
                    show += String.fromCharCode(160) + "GB";
                }
                else {
                    if (bytes > Math.pow(1000, 2)) {
                        show += round(bytes / Math.pow(1000, 2), 2);
                        show += String.fromCharCode(160) + "MB";
                    }
                    else {
                        if (bytes > Math.pow(1000, 1)) {
                            show += round(bytes / Math.pow(1000, 1), 2);
                            show += String.fromCharCode(160) + "KB";
                        }
                        else {
                                show += bytes;
                                show += String.fromCharCode(160) + "B";
                        }
                    }
                }
            }
        }
        break;
    default:
        if (bytes > Math.pow(1024, 5)) {
            show += round(bytes / Math.pow(1024, 5), 2);
            show += String.fromCharCode(160) + "PiB";
        }
        else {
            if (bytes > Math.pow(1024, 4)) {
                show += round(bytes / Math.pow(1024, 4), 2);
                show += String.fromCharCode(160) + "TiB";
            }
            else {
                if (bytes > Math.pow(1024, 3)) {
                    show += round(bytes / Math.pow(1024, 3), 2);
                    show += String.fromCharCode(160) + "GiB";
                }
                else {
                    if (bytes > Math.pow(1024, 2)) {
                        show += round(bytes / Math.pow(1024, 2), 2);
                        show += String.fromCharCode(160) + "MiB";
                    }
                    else {
                        if (bytes > Math.pow(1024, 1)) {
                            show += round(bytes / Math.pow(1024, 1), 2);
                            show += String.fromCharCode(160) + "KiB";
                        }
                        else {
                            show += bytes;
                            show += String.fromCharCode(160) + "B";
                        }
                    }
                }
            }
        }
    }
    return show;
}

/**
 * round a given value to the specified precision, difference to Math.round() is that there
 * will be appended Zeros to the end if the precision is not reached (0.1 gets rounded to 0.100 when precision is set to 3)
 * @param {Number} x value to round
 * @param {Number} n precision
 * @return {String}
 */
function round(x, n) {
    var e = 0, k = "";
    if (n < 0 || n > 14) {
        return 0;
    }
    if (n === 0) {
        return Math.round(x);
    } else {
        e = Math.pow(10, n);
        k = (Math.round(x * e) / e).toString();
        if (k.indexOf('.') === -1) {
            k += '.';
        }
        k += e.toString().substring(1);
        return k.substring(0, k.indexOf('.') + n + 1);
    }
}