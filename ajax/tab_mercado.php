<?php
	require_once("../php/aut.php");
    include("../conexion/bdd.php");
?>
     <br><center><h4>Añadir nuevo</h4></center><br>
              <form action="php/mercado_editorial.php" method="POST">
              <div class="row"> 
                <div class="col-sm-3">
                  <div class="form-group">
                      <label for="tipo_editorial" class="control-label no-padding-right">Editorial</label>
                      <select name="tipo_editorial" id="tipo_editorial" class="form-control" required="">
                        <option value="">Seleccione</option>
                        <?php

                           $sql = "SELECT * FROM editoriales WHERE act=1";

                          $req = $bdd->prepare($sql);
                          $req->execute();
                          $editoriales = $req->fetchAll();

                          foreach ($editoriales as $editorial) {
                            echo '<option value="'.$editorial['id'].'">'.$editorial['editorial'].'</option>';
                          }

                        ?>
                      </select>
                    </div>
                  </div> 
            
                  <div class="col-sm-2">
                    
                    <div class="form-group">
                      <label class="control-label no-padding-right" for="materia_m"> Materia:</label>

                      <select name="materia" id="materia_m" class="form-control materia">
                      <option value="">Seleccionar</option>
                      <?php 
                        $sql = "SELECT id, materia FROM materias";

                        $req = $bdd->prepare($sql);
                        $req->execute();
                        $materias = $req->fetchAll();

                        foreach($materias as $materia) {
                            $id = $materia['id'];
                            $nom = $materia['materia'];
                            echo '<option value="'.$id.'">'.$nom.'</option>';
                        }
                      ?>
                      </select>
                        
                    </div>
                  </div>
              
                  <div class="col-sm-2">
                    
                    <div class="form-group">
                      <label for="grado_m" class="control-label no-padding-right">Grado</label>
                
                        <select name="grado" id="grado_m" class="form-control grado">
                          
                          <option value="">Seleccione</option>

                            <?php 
                              $sql = "SELECT id, grado FROM grados WHERE id !=15 AND id !=16";
                              $req = $bdd->prepare($sql);
                              $req->execute();
                              $grados = $req->fetchAll();
                              foreach($grados as $grado) {
                                          
                                echo '<option value="'.$grado['id'].'">'.$grado['grado'].'</option>';
                              }
                            ?>

                        </select>
                    </div>
                  

                  </div>
                            
                  <div class="col-sm-3 otra_e">
                    <div class="form-group">
                      <label for="libroe_m" class="control-label no-padding-right">Título</label>
                      <input type="text" name="libro" id="libroe_m" class="form-control">
                      
                    </div>
                  </div>

                  <div class="col-sm-2">
                    <div class="form-group">     
                        <label for="vigencia" class="control-label no-padding-right">Vigencia</label>
                        <input type="text" name="vigencia" id="vigencia" class="form-control" placeholder="" >
                    </div>
                  </div>
              </div>
              <input type="hidden" name="libro_m[]" id="libro_m">

              <?php for ($i=1; $i < 10; $i++) { ?>

                <div id="agg_m<?php echo $i;?>" class="d-none">
                  
                  <div class="row"> 
                    <div class="col-sm-3">
                      <div class="form-group">
                          <label for="tipo_editorial<?php echo $i;?>" class="control-label no-padding-right">Editorial</label>
                          <select name="tipo_editorial" id="tipo_editorial<?php echo $i;?>" class="form-control">
                            <option value="">Seleccione</option>
                            <?php

                               $sql = "SELECT * FROM editoriales WHERE act=1";

                              $req = $bdd->prepare($sql);
                              $req->execute();
                              $editoriales = $req->fetchAll();

                              foreach ($editoriales as $editorial) {
                                echo '<option value="'.$editorial['id'].'">'.$editorial['editorial'].'</option>';
                              }

                            ?>
                          </select>
                        </div>
                      </div> 
            
                    <div class="col-sm-2">
                      
                      <div class="form-group">
                        <label class="control-label no-padding-right" for="materia_m<?php echo $i;?>"> Materia:</label>

                        <select name="materia" id="materia_m<?php echo $i;?>" class="form-control materia">
                        <option value="">Seleccione</option>
                        <?php 
                          $sql = "SELECT id, materia FROM materias";

                          $req = $bdd->prepare($sql);
                          $req->execute();
                          $materias = $req->fetchAll();

                          foreach($materias as $materia) {
                              $id = $materia['id'];
                              $nom = $materia['materia'];
                              echo '<option value="'.$id.'">'.$nom.'</option>';
                          }
                        ?>
                        </select>
                          
                      </div>
                    </div>
              
                    <div class="col-sm-2">
                      
                      <div class="form-group">
                        <label for="grado_m<?php echo $i;?>" class="control-label no-padding-right">Grado</label>
                  
                          <select name="grado" id="grado_m<?php echo $i;?>" class="form-control grado">
                            <option value="">Seleccione</option>
                            <?php 
                              $sql = "SELECT id, grado FROM grados WHERE id !=15 AND id !=16";
                              $req = $bdd->prepare($sql);
                              $req->execute();
                              $grados = $req->fetchAll();
                              foreach($grados as $grado) {
                                            
                                echo '<option value="'.$grado['id'].'">'.$grado['grado'].'</option>';
                              }
                            ?>
                          </select>
                      </div>
                    

                    </div>
                            
                    <div class="col-sm-3 otra_e">
                      <div class="form-group">
                        <label for="libroe_m<?php echo $i;?>" class="control-label no-padding-right">Título</label>
                        <input type="text" name="libro" id="libroe_m<?php echo $i;?>" class="form-control">
                        <div id="suggestions1"></div>
                      </div>
                    </div>

                    <div class="col-sm-2">
                      <div class="form-group">     
                          <label for="vigencia<?php echo $i;?>" class="control-label no-padding-right">Vigencia</label>
                          <input type="text" name="vigencia" id="vigencia<?php echo $i;?>" class="form-control" placeholder="" >
                      </div>
                    </div>
                  </div>

                </div>
                
                <input type="hidden" name="libro_m[]" id="libro_m<?php echo $i;?>">


              <?php } ?>

              <a id="agregar_libro_m" style="cursor: pointer;">Agregar libro +</a><br>

              <br>

                <input type="hidden" name="id_colegio" value="<?= htmlspecialchars($_GET['colegio']) ?>">
    			<input type="hidden" name="periodo"    value="<?= htmlspecialchars($_GET['periodo']) ?>">
    			<input type="hidden" name="cod_colegio" value="<?= htmlspecialchars($_GET['codigo']) ?>">
                <?php if($_SESSION["tipo"] !=2 && $_SESSION["tipo"] != 4) { ?>
                  <?php if($_SESSION["zona"] ==$colegio["cod_zona"] || $_SESSION["tipo"] == 1) { ?>
                    <center><button class="btn btn-success">Añadir</button></center><br>
                  <?php } ?>
                <?php } ?>
                </form>
                <!--funcion Separador de miles-->
                            <script>
                              var formatNumber = {
                               separador: ".", // separador para los miles
                               sepDecimal: ',', // separador para los decimales
                               formatear:function (num){
                               num +='';
                               var splitStr = num.split('.');
                               var splitLeft = splitStr[0];
                               var splitRight = splitStr.length > 1 ? this.sepDecimal + splitStr[1] : '';
                               var regx = /(\d+)(\d{3})/;
                               while (regx.test(splitLeft)) {
                               splitLeft = splitLeft.replace(regx, '$1' + this.separador + '$2');
                               }
                               return this.simbol + splitLeft +splitRight;
                               },
                               new:function(num, simbol){
                               this.simbol = simbol ||'';
                               return this.formatear(num);
                               }
                              }
                            </script>
                            

                            <?php
                            
                            $sql = "SELECT m.id, b.materia, m.id_grado, c.grado,m.libro,m.precio, m.tasa_compra, m.descuento, m.precio, e.editorial FROM mercado_editorial m JOIN materias b ON m.id_materia=b.id JOIN grados c ON m.id_grado=c.id JOIN editoriales e ON e.id=m.editorial WHERE id_colegio='".$_GET['colegio']."' AND id_periodo='".$_GET['periodo']."'";


                            
                              $req = $bdd->prepare($sql);
                              $req->execute();
                              $libros_m = $req->fetchAll();




                             
                               echo "<form action='php/modificar_mercado.php' method='POST'>";
                                
                             
                               
                         
                              
                              echo "<script src='../vendors/scripts/jquery-2.1.4.min.js'></script><div class='table-responsive'>
                                  <table class='table table-bordered'>
                                    <thead>
                                      <th>Editorial</th>
                                      <th>Título</th>
                                      <th>Materia</th>
                                      <th>Grado</th>
                                      <!--<th>Paralelos</th>-->
                                      <th>Alumnos</th>
                                      <th>Tasa de compra</th>
                                      <th>PVP</th>
                                      <th>Descuento</th>
                                      <th>Precio neto</th>
                                      <th>Venta potencial</th>";
                                      
                                      /*if ($_SESSION
                                        ["tipo"] != 1) {
                                        
                                        echo "<th>Aprobado</th>";

                                      }else{
                                        echo "<th>Aprobado <input type='checkbox' id='seleccionar_pre'></th>";
                                      }*/

                                      
                                    echo"</thead>
                                    <tbody>";
                              foreach ($libros_m as $libro_m) {

                                  
                                $sq_gp = "SELECT paralelos, SUM(alumnos) as alumnos FROM grados_paralelos WHERE id_colegio='".$_GET['colegio']."' AND id_grado='".$libro_m["id_grado"]."' AND id_periodo='".$_GET['periodo']."'";
 
                                $req_gp = $bdd->prepare($sq_gp);
                                $req_gp->execute();
                                $gp = $req_gp->fetch();

                                  echo "<tr>
                                      <td>".$libro_m["editorial"]."</td>
                                      <td>".$libro_m["libro"]."</td>
                                      <td>".$libro_m["materia"]."</td>";
                                      echo "<td>".$libro_m["grado"]."</td>";
                                      echo"<!--<td>".$gp["paralelos"]."</td>-->
                                      <td id='alm_m".$libro_m["id"]."'>".$gp["alumnos"]."</td>";
                                      if ($libro_m["tasa_compra"] !=0.00) {

                                          $libro_m["tasa_compra"] = $libro_m["tasa_compra"] *100;
                                          echo "<td><input type='text' size='2' name='tasa[]' id='tasa_m".$libro_m["id"]."' value='".$libro_m["tasa_compra"]."'> %</td>";
                                        }else {
                                        
                                          //tasa de compra nueva
                                          if ($libro_m["id_grado"] < 4) {
                                             echo "<td><input type='text' size='2' name='tasa[]' id='tasa_m".$libro_m["id"]."' value='".$gp_periodo["t_preescolar"]."' required> %</td>";
                                          }elseif ($libro_m["id_grado"] < 9 && $libro_m["id_grado"] > 3) {
                                            echo "<td><input type='text' size='2' name='tasa[]' id='tasa_m".$libro_m["id"]."' value='".$gp_periodo["t_primaria"]."' required> %</td>";
                                          }elseif ($libro_m["id_grado"] > 8 && $libro_m["id_grado"] < 13) {
                                            echo "<td><input type='text' size='2' name='tasa[]' id='tasa_m".$libro_m["id"]."' value='".$gp_periodo["t_6_9"]."' required> %</td>";
                                          }else{
                                            echo "<td><input type='text' size='2' name='tasa[]' id='tasa_m".$libro_m["id"]."' value='".$gp_periodo["t_10_11"]."' required> %</td>";
                                          }
                                          

                                        }
                                       

                                        $precio=number_format($libro_m["precio"],0,",", ".");

                                        //echo "<td id='pvp_m".$libro_m["id"]."'>".$precio."</td>";

                                        echo "<td><input type='text' size='4' name='precio[]' id='pvp_s_m".$libro_m["id"]."' value='".$libro_m["precio"]."'></td>";

                                        //echo "<input type='hidden' id='pvp_s_m".$libro_m["id"]."' value='".$libro_m["precio"]."'>";
                                        
                                      if ($libro_m["descuento"] !="") {

                                          $presup_m = $libro_m["descuento"] * 100;
                                          echo "<td><input type='text' size='2' name='descuento[]' id='descuento_m".$libro_m["id"]."' value='".$presup_m."'> %</td>";

                                        }else {

                                          echo "<td><input type='text' size='2' name='descuento[]' value='20' id='descuento_m".$libro_m["id"]."' required> %</td>";
                                        }
                                        if ($libro_m["tasa_compra"] !="") {
                                          $precio_neto= $libro_m["precio"] -( $libro_m["precio"] * $libro_m["descuento"]);

                                          

                                          $venta_p= $precio_neto * floor($gp["alumnos"] * $libro_m["tasa_compra"]/100);
                                          

                                          $precio_ne=number_format($precio_neto,2,",", ".");

                                          echo "<td id='pn_m".$libro_m["id"]."'>".$precio_ne."</td>";

                                          echo "<input type='hidden' id='pn_s_p".$libro_m["id"]."' value='".$precio_neto."'>";

    
                                          $venta_po=number_format($venta_p,0,",", ".");
                                          
                                          echo"<td id='venta_p_m".$libro_m["id"]."' class='venta'>".$venta_po."</td>

                                          <input type='hidden' id='venta_ps_m".$libro_m["id"]."' class='venta1_m' value='".$venta_p."'>";

                                        }else {

                                          echo "<td id='pn_m".$libro_m["id"]."'></td>

                                          <td id='venta_p_m".$libro_m["id"]."' class='venta'></td>

                                          <input type='hidden' id='venta_ps_m".$libro_m["id"]."' class='venta1_m'>";

                                        }

                                  

                                        /*if ($_SESSION["tipo"] !=1) {

                                          if ($presup["aprobado"]==1) {
                                        
                                            echo '<td class="text-success">Si</td>'; 

                                          }else{

                                            echo '<td class="text-danger">No</td>'; 

                                          }

                                         
                                        }else{

                                          if ($presup["aprobado"]==1) {
                                        
                                          echo '<td><input type="checkbox" name="aprobar[]" value="'.$presup["id"].'" checked></td>'; 

                                          }else{

                                            echo '<td><input type="checkbox" name="aprobar[]" value="'.$presup["id"].'"></td>'; 

                                          }
                                          

                                        }*/
                                        
                                        
                                      if ($_SESSION["tipo"] !=1) {
                                        echo "<input type='hidden' name='mercado_m[]' id='mercado_m".$libro_m["id"]."'>";
                                      }else{
                                         echo "<input type='hidden' name='mercado_m[]' value='".$libro_m["id"]."' id='mercado_m".$libro_m["id"]."'>";
                                      }
                                      

                                      echo "<script>
                                        $('#descuento_m".$libro_m["id"]."').keyup(function(){
                                            var pvp=parseInt($('#pvp_s_m".$libro_m["id"]."').val());

                                            var descuento=parseFloat($('#descuento_m".$libro_m["id"]."').val());
                                            descuento= descuento/100;

                                            var precio_neto= pvp - (pvp * descuento);

                                            if(isNaN(precio_neto)){
                                              precio_neto=0
                                            }

                                            $('#pn_m".$libro_m["id"]."').text(formatNumber.new(precio_neto));


                                            var tasa_c=parseInt($('#tasa_m".$libro_m["id"]."').val());

                                            tasa_c=tasa_c/100;

                                            var alumnos=parseInt($('#alm_m".$libro_m["id"]."').text());

                                            var vp= precio_neto *(Math.floor(alumnos*tasa_c))

                                            if(isNaN(vp)){
                                              vp=0;
                                            }

                                            $('#venta_p_m".$libro_m["id"]."').text(formatNumber.new(vp));

                                            $('#venta_ps_m".$libro_m["id"]."').val(vp);


                                            $('#mercado_m".$libro_m["id"]."').val(".$libro_m["id"]."+'/'+tasa_c+'/'+descuento+'/'+pvp);

                                            var total_vp_m=0;

                                            $('.venta1_m').each(function(){

                                              total_vp_m+=parseFloat($(this).val()) || 0;
                                              total_vp_m=Math.round(total_vp_m * 100) / 100;

                                            });
                                                                              
                                            $('#total_vp_m').text(formatNumber.new(total_vp_m));

                                          })

                                          $('#tasa_m".$libro_m["id"]."').keyup(function(){
                                            var pvp=parseInt($('#pvp_s_m".$libro_m["id"]."').val());

                                            var descuento=parseFloat($('#descuento_m".$libro_m["id"]."').val());
                                            descuento= descuento/100;

                                            var precio_neto= pvp - (pvp * descuento);

                                            if(isNaN(precio_neto)){
                                              precio_neto=0
                                            }

                                            $('#pn_m".$libro_m["id"]."').text(formatNumber.new(precio_neto));


                                            var tasa_c=parseInt($('#tasa_m".$libro_m["id"]."').val());

                                            tasa_c=tasa_c/100;

                                            var alumnos=parseInt($('#alm_m".$libro_m["id"]."').text());

                                            var vp= precio_neto *(Math.floor(alumnos*tasa_c))

                                            if(isNaN(vp)){
                                              vp=0;
                                            }

                                            $('#venta_p_m".$libro_m["id"]."').text(formatNumber.new(vp));

                                            $('#venta_ps_m".$libro_m["id"]."').val(vp);


                                            $('#mercado_m".$libro_m["id"]."').val(".$libro_m["id"]."+'/'+tasa_c+'/'+descuento+'/'+pvp);


                                            var total_vp_m=0;

                                            $('.venta1_m').each(function(){

                                              total_vp_m+=parseFloat($(this).val()) || 0;
                                              total_vp_m=Math.round(total_vp_m * 100) / 100;

                                            });
                                                                              
                                            $('#total_vp_m').text(formatNumber.new(total_vp_m));

                                          })

                                          $('#pvp_s_m".$libro_m["id"]."').keyup(function(){
                                            var pvp=parseInt($('#pvp_s_m".$libro_m["id"]."').val());

                                            var descuento=parseFloat($('#descuento_m".$libro_m["id"]."').val());
                                            descuento= descuento/100;

                                            var precio_neto= pvp - (pvp * descuento);

                                            if(isNaN(precio_neto)){
                                              precio_neto=0
                                            }

                                            $('#pn_m".$libro_m["id"]."').text(formatNumber.new(precio_neto));


                                            var tasa_c=parseInt($('#tasa_m".$libro_m["id"]."').val());

                                            tasa_c=tasa_c/100;

                                            var alumnos=parseInt($('#alm_m".$libro_m["id"]."').text());

                                            var vp= precio_neto *(Math.floor(alumnos*tasa_c))

                                            if(isNaN(vp)){
                                              vp=0;
                                            }

                                            $('#venta_p_m".$libro_m["id"]."').text(formatNumber.new(vp));

                                            $('#venta_ps_m".$libro_m["id"]."').val(vp);


                                            $('#mercado_m".$libro_m["id"]."').val(".$libro_m["id"]."+'/'+tasa_c+'/'+descuento+'/'+pvp);


                                            var total_vp_m=0;

                                            $('.venta1_m').each(function(){

                                              total_vp_m+=parseFloat($(this).val()) || 0;
                                              total_vp_m=Math.round(total_vp_m * 100) / 100;

                                            });
                                                                              
                                            $('#total_vp_m').text(formatNumber.new(total_vp_m));

                                          })




                                      </script>

                                      
                                    </tr>";

                                


                              if($_SESSION["tipo"] !=2 ) {
                                /*if ($gp_periodo["f_cierre"] > date("Y-m-d")){
                                echo'<center><button class="btn btn-primary">Actualizar</button></center>
                                <input type="hidden" name="id_colegio" id="cole" value="'.$colegio["id"].'">
                              <input type="hidden" name="cod_colegio" value="'.$colegio["codigo"].'">
                              <input type="hidden" name="id_area" value="'.$area["aid"].'"> 
                                </form></div>';
                              }*/
                            }
                              }
                              echo "<tr>
                                <td><b>Total:</b></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td id='total_vp_m'></td>
                                </tr>";
                              echo '</tbody>
                                  </table></div>
                                   <input type="hidden" name="id_colegio" id="cole" value="'.$colegio["id"].'">
                                    <input type="hidden" name="codigo" value="'.$colegio["codigo"].'">
                                    <input type="hidden" name="periodo" value="'.$gp_periodo["id"].'">';
                                    
                                   
                                      echo '<center>';
                                    
                              
                                      if($_SESSION["tipo"] !=2 && $_SESSION["tipo"] != 4) {
                                        if($_SESSION["zona"] ==$_GET['codigo'] || $_SESSION["tipo"] == 1) { 
                                          if ($_GET["f_cierre"] > date("Y-m-d")) {
                                            echo '<button class="btn btn-primary">Guardar</button> ';
                                          }
                                        }
                                      }
                                    echo '</center>';
                                        
                                      
                                      
                                      
                                  
                                    echo "</form>";

                                    echo '<a class="btn btn-success" href="php/mercado_excel.php?cole='.$colegio['id'].'&periodo='.$periodo.'">Exportar Excel</a>';

                                    //echo '<br><a class="btn btn-success" href="php/presupuesto_excel.php?cole='.$colegio['id'].'&periodo='.$periodo.'">Exportar Excel</a>';
                                  
                           ?>
 <script src="../vendors/scripts/core.js"></script>
<script src="../src/plugins/datatables/js/jquery.dataTables.min.js"></script>
<script src="../src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
<script src="../src/plugins/datatables/js/dataTables.responsive.min.js"></script>
<script src="../src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
<script src="src/plugins/datatables/js/natural.js"></script>
 <script>

 	$('#tipo_editorial').on('change',function(){
          var edit =$('#tipo_editorial').val();
          var mat =$('#materia_m').val();
          var grad =$('#grado_m').val();
          var lib=$('#libroe_m').val();
          var vig=$('#vigencia').val();
          $('#libro_m').val(edit+'/'+mat+'/'+grad+'/'+lib+'/'+vig);

        })

        $('#materia_m').on('change',function(){
          var edit =$('#tipo_editorial').val();
          var mat =$('#materia_m').val();
          var grad =$('#grado_m').val();
          var lib=$('#libroe_m').val();
          var vig=$('#vigencia').val();
          $('#libro_m').val(edit+'/'+mat+'/'+grad+'/'+lib+'/'+vig);

        })

        $('#grado_m').on('change',function(){

          var edit =$('#tipo_editorial').val();
          var mat =$('#materia_m').val();
          var grad =$('#grado_m').val();
          var lib=$('#libroe_m').val();
          var vig=$('#vigencia').val();
          $('#libro_m').val(edit+'/'+mat+'/'+grad+'/'+lib+'/'+vig);

        })

        $('#libroe_m').keyup(function(){

          var edit =$('#tipo_editorial').val();
          var mat =$('#materia_m').val();
          var grad =$('#grado_m').val();
          var lib=$('#libroe_m').val();
          var vig=$('#vigencia').val();
          $('#libro_m').val(edit+'/'+mat+'/'+grad+'/'+lib+'/'+vig);

        })

        $('#vigencia').keyup(function(){

          var edit =$('#tipo_editorial').val();
          var mat =$('#materia_m').val();
          var grad =$('#grado_m').val();
          var lib=$('#libroe_m').val();
          var vig=$('#vigencia').val();
          $('#libro_m').val(edit+'/'+mat+'/'+grad+'/'+lib+'/'+vig);

        })

 	var m = 1;
        $("#agregar_libro_m").click(function(){

          if (m>98) {
            $("#agregar_libro_m").addClass("d-none");
          }
      
          $("#agg_m"+m).removeClass("d-none")

          m++;

          <?php for ($i=1; $i < 8; $i++) { ?>

          

            $('#tipo_editorial<?php echo $i; ?>').on('change',function(){
              var edit =$('#tipo_editorial<?php echo $i; ?>').val();
              var mat =$('#materia_m<?php echo $i; ?>').val();
              var grad =$('#grado_m<?php echo $i; ?>').val();
              var lib=$('#libroe_m<?php echo $i; ?>').val();
              var vig=$('#vigencia<?php echo $i; ?>').val();
              $('#libro_m<?php echo $i; ?>').val(edit+'/'+mat+'/'+grad+'/'+lib+'/'+vig);

            })

            $('#materia_m<?php echo $i; ?>').on('change',function(){
              var edit =$('#tipo_editorial<?php echo $i; ?>').val();
              var mat =$('#materia_m<?php echo $i; ?>').val();
              var grad =$('#grado_m<?php echo $i; ?>').val();
              var lib=$('#libroe_m<?php echo $i; ?>').val();
              var vig=$('#vigencia<?php echo $i; ?>').val();
              $('#libro_m<?php echo $i; ?>').val(edit+'/'+mat+'/'+grad+'/'+lib+'/'+vig);

            })

            $('#grado_m<?php echo $i; ?>').on('change',function(){

              var edit =$('#tipo_editorial<?php echo $i; ?>').val();
              var mat =$('#materia_m<?php echo $i; ?>').val();
              var grad =$('#grado_m<?php echo $i; ?>').val();
              var lib=$('#libroe_m<?php echo $i; ?>').val();
              var vig=$('#vigencia<?php echo $i; ?>').val();
              $('#libro_m<?php echo $i; ?>').val(edit+'/'+mat+'/'+grad+'/'+lib+'/'+vig);

            })

            $('#libro_m<?php echo $i; ?>').keyup(function(){

              var edit =$('#tipo_editorial<?php echo $i; ?>').val();
              var mat =$('#materia_m<?php echo $i; ?>').val();
              var grad =$('#grado_m<?php echo $i; ?>').val();
              var lib=$('#libroe_m<?php echo $i; ?>').val();
              var vig=$('#vigencia<?php echo $i; ?>').val();
              $('#libro_m<?php echo $i; ?>').val(edit+'/'+mat+'/'+grad+'/'+lib+'/'+vig);

            })

            $('#vigencia<?php echo $i; ?>').keyup(function(){

              var edit =$('#tipo_editorial<?php echo $i; ?>').val();
              var mat =$('#materia_m<?php echo $i; ?>').val();
              var grad =$('#grado_m<?php echo $i; ?>').val();
              var lib=$('#libroe_m<?php echo $i; ?>').val();
              var vig=$('#vigencia<?php echo $i; ?>').val();
              $('#libro_m<?php echo $i; ?>').val(edit+'/'+mat+'/'+grad+'/'+lib+'/'+vig);

            })

          <?php } ?>

      
        })
 </script>