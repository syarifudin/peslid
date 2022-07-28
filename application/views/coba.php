<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<title></title>
<script src="<?=base_url();?>js/jspdf.debug.js"></script>
<script src="<?=base_url();?>js/jspdf.plugin.autotable.js"></script> 
</head>
 <body>
     <div id="tblSaveAsPdf" class="table-details margin-top-small collapse" >
                    <table class="table table-bordered table-striped table-hover bootstrap-datatable datatable dataTable table-responsive">
                        <thead>
                            <tr role="row"> 
                                <th role="columnheader" class="col-lg-2">Account</th>
                                <th role="columnheader" class="col-lg-3">Description</th>
                                <th role="columnheader" class="col-lg-3">JournalEntry#</th>
                                <th role="columnheader" class="col-lg-2">Debit</th>
                                <th role="columnheader" class="col-lg-2" style="text-align: right" >Credit</th>
                            </tr>
                        </thead>
                         <tfoot>
                            <tr role="row">
                                <td ><span>TOTAL</span> </td>
                               <td></td>  
                                <td></td>                                                        
                                <td >
                                    <span data-bind="text: pp_formattedDebitTotal"></span>
                                </td>
                                <td   style="text-align: right">
                                   <span data-bind="text: pp_formattedCreditTotal"></span>
                                </td>
                            </tr>
                      </tfoot>
                        <tbody  data-bind="foreach: pp_voidCheckGLSummarys">
                            <tr >
                                <td>
                                    <span data-bind="text: pp_account"></span>
                                </td>
                                <td >
                                    <span data-bind="text: pp_accountName"></span>
                                </td>
                                <td>
                                    <span data-bind="text: pp_entry"></span>
                                </td>
                                <td>
                                    <span data-bind="text: pp_amountDebit"></span>
                                </td>
                                <td>
                                    <span data-bind="text: pp_amountCredit"></span>
                                </td>
                            </tr>
                            </table>
                            </div>
                        </tbody>  
      <div>
     <button onclick="demoFromHTML(tblSaveAsPdf)" class="button">SavePDF</button></p>     </div>
</div>

<script>
function demoFromHTML(targetId) {

    var pdf = new jsPDF('p', 'pt', 'letter')
        , source = $('#tblSaveAsPdf' + targetId)[0]
        ,specialElementHandlers = {          
            '#tblSaveAsPdf': function(element, renderer){            
                return true
            }
        }

        margins = {
            top: 40,
            bottom: 60,
            left: 70,
            width: 522,       
        };

        pdf.fromHTML(
           source
           , margins.left
           , margins.top 
           , {
               'width': margins.width 
               , 'elementHandlers': specialElementHandlers
           },
           function (dispose) {

               pdf.save('Test.pdf');
           },
           margins
       )
    }
</script>
</table>
</html>