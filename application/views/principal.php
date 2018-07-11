<?php if (Auth::user()->n_project == 'Gestion') { ?>
    <!--        <div>
                <script type='text/javascript' src='http://181.49.46.6/javascripts/api/viz_v1.js'></script><div class='tableauPlaceholder' style='width: 100%; height: 619px;'><object class='tableauViz' width='100%' height='619' style='display:none;'><param name='host_url' value='http%3A%2F%2F181.49.46.6%2F' /> <param name='embed_code_version' value='3' /> <param name='site_root' value='' /><param name='name' value='TVIPInstalaciones&#47;EstadodeOTs' /><param name='tabs' value='no' /><param name='toolbar' value='yes' /><param name='showAppBanner' value='false' /><param name='filter' value='iframeSizedToWindow=true' /></object></div>
            </div>-->
    <h1 id="como_vamos">¿Cómo vamos?</h1>
    <div class="col col-md-6" style="height: 300px; border: 1px solid;">Grafica 1</div>
    <div class="col col-md-6" style="height: 300px; border: 1px solid;">Grafica 2</div>
    <div class="col col-md-12">
        <h2 id="Tareas_progreso">Resumen Tareas en Progreso</h2>
        <table class="table table-bordered dataTable_camilo" id="tabla_resumen">
            <thead>
                <tr>
                    <th>Tipo OT Hija</th>
                    <th>Cant Total</th>
                    <th>En Tiempos</th>
                    <th>Fuera de tiempos</th>
                    <th>Tipo OT Hija</th>
                    <th>Cant Total</th>
                    <th>En Tiempos</th>
                    <th>Fuera de tiempos</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = count($registros);
                $mitad = ($total / 2);
                for ($i = 0; $i < $total; $i = $i + 2) {
                    $terna = ($registros[$i]->en_tiempo == 0 && $registros[$i]->fuera_tiempo == 0) ? $registros[$i]->count : $registros[$i]->en_tiempo;
                    echo "<tr>";
                    echo " <td><b>" . $registros[$i]->n_name_tipo . "</b></td>";
                    echo " <td>" . $registros[$i]->count . "</td>";
                    echo " <td><a onclick='showModalDetResInTimes(" . $registros[$i]->k_id_tipo . ");'>" . $terna . "</a></td>";
                    echo " <td><a onclick='showModalDetResOutTime(" . $registros[$i]->k_id_tipo . ");'>" . $registros[$i]->fuera_tiempo . "</a></td>";
                    if (isset($registros[$i + 1])) {
                        $terna1 = ($registros[$i + 1]->en_tiempo == 0 && $registros[$i + 1]->fuera_tiempo == 0) ? $registros[$i + 1]->count : $registros[$i + 1]->en_tiempo;
                        echo " <td><b>" . $registros[$i + 1]->n_name_tipo . "</b></td>";
                        echo " <td>" . $registros[$i + 1]->count . "</td>";
                        echo " <td><a onclick='showModalDetResInTimes(" . $registros[$i + 1]->k_id_tipo . ");'>" . $terna1 . "</a></td>";
                        echo " <td><a onclick='showModalDetResOutTime(" . $registros[$i + 1]->k_id_tipo . ");'>" . $registros[$i + 1]->fuera_tiempo . "</a></td>";
                    }
                    echo "</tr>";
                }
                ?>                
            </tbody>
        </table>
    </div>
    <h2>Detalles</h2>

    <!-- ****************************MENU STICK ************************************************ -->
    <div class="contenedor closed" id="content_fixed">
        <div id="btn_fixed" >
            <span class="rotate-90 text">
                <i class="glyphicon glyphicon-chevron-up"></i><span class="espaciomenu">Ver menú</span>
            </span>
        </div>
        <div class="hidden" id="menu_fixed">
            <span id="btn_close_fixed">
                <i class="glyphicon glyphicon-chevron-right"></i> Cerrar
            </span>
            <div class="menu-fixed">
                <ul>
                    <li><a href="#como_vamos">¿Cómo vamos?</a></li>
                    <li><a href="#Tareas_progreso">Tareas en progreso</a></li>
                    <li><a href="#Detalles">Detalles</a></li>
                </ul>
            </div>
        </div>
    </div>
    <span id="Detalles"></span>

    <!--*********************  MODULO PESTAÑAS  *********************-->
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#fuera_tiempos">Fuera de Tiempos</a></li>
        <li class=""><a data-toggle="tab" href="#en_tiempos">En Tiempos</a></li>
        <li class=""><a data-toggle="tab" href="#todo">Todo</a></li>
    </ul>

    <!--*********************  CONTENIDO PESTAÑAS  *********************-->
    <div class="tab-content">

        <div id="fuera_tiempos" class="tab-pane fade in active">
            <h3>Fuera de Tiempos</h3>
            <table id="tablaFueraTiempos" class="table table-hover table-bordered table-striped dataTable_camilo" width="100%">
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div id="en_tiempos" class="tab-pane fade">
            <h3>En Tiempos</h3>
            <table id="tablaEnTiempos" class="table table-hover table-bordered table-striped dataTable_camilo" width="100%"></table>
        </div>

        <div id="todo" class="tab-pane fade">
            <h3>Todo</h3>
            <table id="tablaTodo" class="table table-hover table-bordered table-striped dataTable_camilo" width="100%"></table>
        </div>

    </div>
<!--    <hr>
    <table id="example" class="table table-hover table-bordered table-striped dataTable_camilo" style="width:100%">
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
                <th>Salary</th>
                <th>Salary</th>
                <th>Salary</th>
                <th>Salary</th>
            </tr>
        </tfoot>
        <thead>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
                <th>Salary</th>
                <th>Salary</th>
                <th>Salary</th>
                <th>Salary</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Tiger Nixon</td>
                <td>System Architect</td>
                <td>Edinburgh</td>
                <td>61</td>
                <td>2011/04/25</td>
                <td>$320,800</td>
                <td>$320,800</td>
                <td>$320,800</td>
                <td>$320,800</td>
                <td>$320,800</td>
            </tr>
            <tr>
                <td>Garrett Winters</td>
                <td>Accountant</td>
                <td>Tokyo</td>
                <td>63</td>
                <td>2011/07/25</td>
                <td>$170,750</td>
                <td>$170,750</td>
                <td>$170,750</td>
                <td>$170,750</td>
                <td>$170,750</td>
            </tr>
            <tr>
                <td>Ashton Cox</td>
                <td>Junior Technical Author</td>
                <td>San Francisco</td>
                <td>66</td>
                <td>2009/01/12</td>
                <td>$86,000</td>
                <td>$86,000</td>
                <td>$86,000</td>
                <td>$86,000</td>
                <td>$86,000</td>
            </tr>
            <tr>
                <td>Cedric Kelly</td>
                <td>Senior Javascript Developer</td>
                <td>Edinburgh</td>
                <td>22</td>
                <td>2012/03/29</td>
                <td>$433,060</td>
                <td>$433,060</td>
                <td>$433,060</td>
                <td>$433,060</td>
                <td>$433,060</td>
            </tr>
            <tr>
                <td>Airi Satou</td>
                <td>Accountant</td>
                <td>Tokyo</td>
                <td>33</td>
                <td>2008/11/28</td>
                <td>$162,700</td>
                <td>$162,700</td>
                <td>$162,700</td>
                <td>$162,700</td>
                <td>$162,700</td>
            </tr>
            <tr>
                <td>Brielle Williamson</td>
                <td>Integration Specialist</td>
                <td>New York</td>
                <td>61</td>
                <td>2012/12/02</td>
                <td>$372,000</td>
                <td>$372,000</td>
                <td>$372,000</td>
                <td>$372,000</td>
                <td>$372,000</td>
            </tr>
            <tr>
                <td>Herrod Chandler</td>
                <td>Sales Assistant</td>
                <td>San Francisco</td>
                <td>59</td>
                <td>2012/08/06</td>
                <td>$137,500</td>
                <td>$137,500</td>
                <td>$137,500</td>
                <td>$137,500</td>
                <td>$137,500</td>
            </tr>
            <tr>
                <td>Rhona Davidson</td>
                <td>Integration Specialist</td>
                <td>Tokyo</td>
                <td>55</td>
                <td>2010/10/14</td>
                <td>$327,900</td>
                <td>$327,900</td>
                <td>$327,900</td>
                <td>$327,900</td>
                <td>$327,900</td>
            </tr>
            <tr>
                <td>Colleen Hurst</td>
                <td>Javascript Developer</td>
                <td>San Francisco</td>
                <td>39</td>
                <td>2009/09/15</td>
                <td>$205,500</td>
                <td>$205,500</td>
                <td>$205,500</td>
                <td>$205,500</td>
                <td>$205,500</td>
            </tr>
            <tr>
                <td>Sonya Frost</td>
                <td>Software Engineer</td>
                <td>Edinburgh</td>
                <td>23</td>
                <td>2008/12/13</td>
                <td>$103,600</td>
                <td>$103,600</td>
                <td>$103,600</td>
                <td>$103,600</td>
                <td>$103,600</td>
            </tr>
            <tr>
                <td>Jena Gaines</td>
                <td>Office Manager</td>
                <td>London</td>
                <td>30</td>
                <td>2008/12/19</td>
                <td>$90,560</td>
                <td>$90,560</td>
                <td>$90,560</td>
                <td>$90,560</td>
                <td>$90,560</td>
            </tr>
            <tr>
                <td>Quinn Flynn</td>
                <td>Support Lead</td>
                <td>Edinburgh</td>
                <td>22</td>
                <td>2013/03/03</td>
                <td>$342,000</td>
                <td>$342,000</td>
                <td>$342,000</td>
                <td>$342,000</td>
                <td>$342,000</td>
            </tr>
            <tr>
                <td>Charde Marshall</td>
                <td>Regional Director</td>
                <td>San Francisco</td>
                <td>36</td>
                <td>2008/10/16</td>
                <td>$470,600</td>
                <td>$470,600</td>
                <td>$470,600</td>
                <td>$470,600</td>
                <td>$470,600</td>
            </tr>
            <tr>
                <td>Haley Kennedy</td>
                <td>Senior Marketing Designer</td>
                <td>London</td>
                <td>43</td>
                <td>2012/12/18</td>
                <td>$313,500</td>
                <td>$313,500</td>
                <td>$313,500</td>
                <td>$313,500</td>
                <td>$313,500</td>
            </tr>
            <tr>
                <td>Tatyana Fitzpatrick</td>
                <td>Regional Director</td>
                <td>London</td>
                <td>19</td>
                <td>2010/03/17</td>
                <td>$385,750</td>
                <td>$385,750</td>
                <td>$385,750</td>
                <td>$385,750</td>
                <td>$385,750</td>
            </tr>
            <tr>
                <td>Michael Silva</td>
                <td>Marketing Designer</td>
                <td>London</td>
                <td>66</td>
                <td>2012/11/27</td>
                <td>$198,500</td>
                <td>$198,500</td>
                <td>$198,500</td>
                <td>$198,500</td>
                <td>$198,500</td>
            </tr>
            <tr>
                <td>Paul Byrd</td>
                <td>Chief Financial Officer (CFO)</td>
                <td>New York</td>
                <td>64</td>
                <td>2010/06/09</td>
                <td>$725,000</td>
                <td>$725,000</td>
                <td>$725,000</td>
                <td>$725,000</td>
                <td>$725,000</td>
            </tr>
            <tr>
                <td>Gloria Little</td>
                <td>Systems Administrator</td>
                <td>New York</td>
                <td>59</td>
                <td>2009/04/10</td>
                <td>$237,500</td>
                <td>$237,500</td>
                <td>$237,500</td>
                <td>$237,500</td>
                <td>$237,500</td>
            </tr>
            <tr>
                <td>Bradley Greer</td>
                <td>Software Engineer</td>
                <td>London</td>
                <td>41</td>
                <td>2012/10/13</td>
                <td>$132,000</td>
                <td>$132,000</td>
                <td>$132,000</td>
                <td>$132,000</td>
                <td>$132,000</td>
            </tr>
            <tr>
                <td>Dai Rios</td>
                <td>Personnel Lead</td>
                <td>Edinburgh</td>
                <td>35</td>
                <td>2012/09/26</td>
                <td>$217,500</td>
                <td>$217,500</td>
                <td>$217,500</td>
                <td>$217,500</td>
                <td>$217,500</td>
            </tr>
            <tr>
                <td>Jenette Caldwell</td>
                <td>Development Lead</td>
                <td>New York</td>
                <td>30</td>
                <td>2011/09/03</td>
                <td>$345,000</td>
                <td>$345,000</td>
                <td>$345,000</td>
                <td>$345,000</td>
                <td>$345,000</td>
            </tr>
            <tr>
                <td>Yuri Berry</td>
                <td>Chief Marketing Officer (CMO)</td>
                <td>New York</td>
                <td>40</td>
                <td>2009/06/25</td>
                <td>$675,000</td>
                <td>$675,000</td>
                <td>$675,000</td>
                <td>$675,000</td>
                <td>$675,000</td>
            </tr>
            <tr>
                <td>Caesar Vance</td>
                <td>Pre-Sales Support</td>
                <td>New York</td>
                <td>21</td>
                <td>2011/12/12</td>
                <td>$106,450</td>
                <td>$106,450</td>
                <td>$106,450</td>
                <td>$106,450</td>
                <td>$106,450</td>
            </tr>
            <tr>
                <td>Doris Wilder</td>
                <td>Sales Assistant</td>
                <td>Sidney</td>
                <td>23</td>
                <td>2010/09/20</td>
                <td>$85,600</td>
                <td>$85,600</td>
                <td>$85,600</td>
                <td>$85,600</td>
                <td>$85,600</td>
            </tr>
            <tr>
                <td>Angelica Ramos</td>
                <td>Chief Executive Officer (CEO)</td>
                <td>London</td>
                <td>47</td>
                <td>2009/10/09</td>
                <td>$1,200,000</td>
                <td>$1,200,000</td>
                <td>$1,200,000</td>
                <td>$1,200,000</td>
                <td>$1,200,000</td>
            </tr>
            <tr>
                <td>Gavin Joyce</td>
                <td>Developer</td>
                <td>Edinburgh</td>
                <td>42</td>
                <td>2010/12/22</td>
                <td>$92,575</td>
                <td>$92,575</td>
                <td>$92,575</td>
                <td>$92,575</td>
                <td>$92,575</td>
            </tr>
            <tr>
                <td>Jennifer Chang</td>
                <td>Regional Director</td>
                <td>Singapore</td>
                <td>28</td>
                <td>2010/11/14</td>
                <td>$357,650</td>
                <td>$357,650</td>
                <td>$357,650</td>
                <td>$357,650</td>
                <td>$357,650</td>
            </tr>
            <tr>
                <td>Brenden Wagner</td>
                <td>Software Engineer</td>
                <td>San Francisco</td>
                <td>28</td>
                <td>2011/06/07</td>
                <td>$206,850</td>
                <td>$206,850</td>
                <td>$206,850</td>
                <td>$206,850</td>
                <td>$206,850</td>
            </tr>
            <tr>
                <td>Fiona Green</td>
                <td>Chief Operating Officer (COO)</td>
                <td>San Francisco</td>
                <td>48</td>
                <td>2010/03/11</td>
                <td>$850,000</td>
                <td>$850,000</td>
                <td>$850,000</td>
                <td>$850,000</td>
                <td>$850,000</td>
            </tr>
            <tr>
                <td>Shou Itou</td>
                <td>Regional Marketing</td>
                <td>Tokyo</td>
                <td>20</td>
                <td>2011/08/14</td>
                <td>$163,000</td>
                <td>$163,000</td>
                <td>$163,000</td>
                <td>$163,000</td>
                <td>$163,000</td>
            </tr>
            <tr>
                <td>Michelle House</td>
                <td>Integration Specialist</td>
                <td>Sidney</td>
                <td>37</td>
                <td>2011/06/02</td>
                <td>$95,400</td>
                <td>$95,400</td>
                <td>$95,400</td>
                <td>$95,400</td>
                <td>$95,400</td>
            </tr>
            <tr>
                <td>Suki Burks</td>
                <td>Developer</td>
                <td>London</td>
                <td>53</td>
                <td>2009/10/22</td>
                <td>$114,500</td>
                <td>$114,500</td>
                <td>$114,500</td>
                <td>$114,500</td>
                <td>$114,500</td>
            </tr>
            <tr>
                <td>Prescott Bartlett</td>
                <td>Technical Author</td>
                <td>London</td>
                <td>27</td>
                <td>2011/05/07</td>
                <td>$145,000</td>
                <td>$145,000</td>
                <td>$145,000</td>
                <td>$145,000</td>
                <td>$145,000</td>
            </tr>
            <tr>
                <td>Gavin Cortez</td>
                <td>Team Leader</td>
                <td>San Francisco</td>
                <td>22</td>
                <td>2008/10/26</td>
                <td>$235,500</td>
                <td>$235,500</td>
                <td>$235,500</td>
                <td>$235,500</td>
                <td>$235,500</td>
            </tr>
            <tr>
                <td>Martena Mccray</td>
                <td>Post-Sales support</td>
                <td>Edinburgh</td>
                <td>46</td>
                <td>2011/03/09</td>
                <td>$324,050</td>
                <td>$324,050</td>
                <td>$324,050</td>
                <td>$324,050</td>
                <td>$324,050</td>
            </tr>
            <tr>
                <td>Unity Butler</td>
                <td>Marketing Designer</td>
                <td>San Francisco</td>
                <td>47</td>
                <td>2009/12/09</td>
                <td>$85,675</td>
                <td>$85,675</td>
                <td>$85,675</td>
                <td>$85,675</td>
                <td>$85,675</td>
            </tr>
            <tr>
                <td>Howard Hatfield</td>
                <td>Office Manager</td>
                <td>San Francisco</td>
                <td>51</td>
                <td>2008/12/16</td>
                <td>$164,500</td>
                <td>$164,500</td>
                <td>$164,500</td>
                <td>$164,500</td>
                <td>$164,500</td>
            </tr>
            <tr>
                <td>Hope Fuentes</td>
                <td>Secretary</td>
                <td>San Francisco</td>
                <td>41</td>
                <td>2010/02/12</td>
                <td>$109,850</td>
                <td>$109,850</td>
                <td>$109,850</td>
                <td>$109,850</td>
                <td>$109,850</td>
            </tr>
            <tr>
                <td>Vivian Harrell</td>
                <td>Financial Controller</td>
                <td>San Francisco</td>
                <td>62</td>
                <td>2009/02/14</td>
                <td>$452,500</td>
                <td>$452,500</td>
                <td>$452,500</td>
                <td>$452,500</td>
                <td>$452,500</td>
            </tr>
            <tr>
                <td>Timothy Mooney</td>
                <td>Office Manager</td>
                <td>London</td>
                <td>37</td>
                <td>2008/12/11</td>
                <td>$136,200</td>
                <td>$136,200</td>
                <td>$136,200</td>
                <td>$136,200</td>
                <td>$136,200</td>
            </tr>
            <tr>
                <td>Jackson Bradshaw</td>
                <td>Director</td>
                <td>New York</td>
                <td>65</td>
                <td>2008/09/26</td>
                <td>$645,750</td>
                <td>$645,750</td>
                <td>$645,750</td>
                <td>$645,750</td>
                <td>$645,750</td>
            </tr>
            <tr>
                <td>Olivia Liang</td>
                <td>Support Engineer</td>
                <td>Singapore</td>
                <td>64</td>
                <td>2011/02/03</td>
                <td>$234,500</td>
                <td>$234,500</td>
                <td>$234,500</td>
                <td>$234,500</td>
                <td>$234,500</td>
            </tr>
            <tr>
                <td>Bruno Nash</td>
                <td>Software Engineer</td>
                <td>London</td>
                <td>38</td>
                <td>2011/05/03</td>
                <td>$163,500</td>
                <td>$163,500</td>
                <td>$163,500</td>
                <td>$163,500</td>
                <td>$163,500</td>
            </tr>
            <tr>
                <td>Sakura Yamamoto</td>
                <td>Support Engineer</td>
                <td>Tokyo</td>
                <td>37</td>
                <td>2009/08/19</td>
                <td>$139,575</td>
                <td>$139,575</td>
                <td>$139,575</td>
                <td>$139,575</td>
                <td>$139,575</td>
            </tr>
            <tr>
                <td>Thor Walton</td>
                <td>Developer</td>
                <td>New York</td>
                <td>61</td>
                <td>2013/08/11</td>
                <td>$98,540</td>
                <td>$98,540</td>
                <td>$98,540</td>
                <td>$98,540</td>
                <td>$98,540</td>
            </tr>
            <tr>
                <td>Finn Camacho</td>
                <td>Support Engineer</td>
                <td>San Francisco</td>
                <td>47</td>
                <td>2009/07/07</td>
                <td>$87,500</td>
                <td>$87,500</td>
                <td>$87,500</td>
                <td>$87,500</td>
                <td>$87,500</td>
            </tr>
            <tr>
                <td>Serge Baldwin</td>
                <td>Data Coordinator</td>
                <td>Singapore</td>
                <td>64</td>
                <td>2012/04/09</td>
                <td>$138,575</td>
                <td>$138,575</td>
                <td>$138,575</td>
                <td>$138,575</td>
                <td>$138,575</td>
            </tr>
            <tr>
                <td>Zenaida Frank</td>
                <td>Software Engineer</td>
                <td>New York</td>
                <td>63</td>
                <td>2010/01/04</td>
                <td>$125,250</td>
                <td>$125,250</td>
                <td>$125,250</td>
                <td>$125,250</td>
                <td>$125,250</td>
            </tr>
            <tr>
                <td>Zorita Serrano</td>
                <td>Software Engineer</td>
                <td>San Francisco</td>
                <td>56</td>
                <td>2012/06/01</td>
                <td>$115,000</td>
                <td>$115,000</td>
                <td>$115,000</td>
                <td>$115,000</td>
                <td>$115,000</td>
            </tr>
            <tr>
                <td>Jennifer Acosta</td>
                <td>Junior Javascript Developer</td>
                <td>Edinburgh</td>
                <td>43</td>
                <td>2013/02/01</td>
                <td>$75,650</td>
                <td>$75,650</td>
                <td>$75,650</td>
                <td>$75,650</td>
                <td>$75,650</td>
            </tr>
            <tr>
                <td>Cara Stevens</td>
                <td>Sales Assistant</td>
                <td>New York</td>
                <td>46</td>
                <td>2011/12/06</td>
                <td>$145,600</td>
                <td>$145,600</td>
                <td>$145,600</td>
                <td>$145,600</td>
                <td>$145,600</td>
            </tr>
            <tr>
                <td>Hermione Butler</td>
                <td>Regional Director</td>
                <td>London</td>
                <td>47</td>
                <td>2011/03/21</td>
                <td>$356,250</td>
                <td>$356,250</td>
                <td>$356,250</td>
                <td>$356,250</td>
                <td>$356,250</td>
            </tr>
            <tr>
                <td>Lael Greer</td>
                <td>Systems Administrator</td>
                <td>London</td>
                <td>21</td>
                <td>2009/02/27</td>
                <td>$103,500</td>
                <td>$103,500</td>
                <td>$103,500</td>
                <td>$103,500</td>
                <td>$103,500</td>
            </tr>
            <tr>
                <td>Jonas Alexander</td>
                <td>Developer</td>
                <td>San Francisco</td>
                <td>30</td>
                <td>2010/07/14</td>
                <td>$86,500</td>
                <td>$86,500</td>
                <td>$86,500</td>
                <td>$86,500</td>
                <td>$86,500</td>
            </tr>
            <tr>
                <td>Shad Decker</td>
                <td>Regional Director</td>
                <td>Edinburgh</td>
                <td>51</td>
                <td>2008/11/13</td>
                <td>$183,000</td>
                <td>$183,000</td>
                <td>$183,000</td>
                <td>$183,000</td>
                <td>$183,000</td>
            </tr>
            <tr>
                <td>Michael Bruce</td>
                <td>Javascript Developer</td>
                <td>Singapore</td>
                <td>29</td>
                <td>2011/06/27</td>
                <td>$183,000</td>
                <td>$183,000</td>
                <td>$183,000</td>
                <td>$183,000</td>
                <td>$183,000</td>
            </tr>
            <tr>
                <td>Donna Snider</td>
                <td>Customer Support</td>
                <td>New York</td>
                <td>27</td>
                <td>2011/01/25</td>
                <td>$112,000</td>
                <td>$112,000</td>
                <td>$112,000</td>
                <td>$112,000</td>
                <td>$112,000</td>
            </tr>
        </tbody>
        
    </table>-->

    <?php
}
if (Auth::user()->n_project == 'Implementacion') {
    ?>
    <!--Header section  -->
    <div class="css_imagen8" style="width: 100%; height: 91%; padding: 0 !important; margin: 0; top: 53px; left: 0; right: 0; position: absolute;">
        <img  style="width: 100%; height: 100%;" src="<?= URL::to('assets/img/img8.png') ?>">
    </div>
    <div class="col-md-9 col-sm-9">
        <div style="height: 400px;"></div>
        <h1 class="head-main">&nbsp;ZTE</h1>
        <span class="head-sub-main">Implementación de servicios -  </span>
        <img class="m-b-25" src="<?= URL::to('assets/img/logoClaro.png') ?>" width="100"/>
        <div class="head-last"><!--texto aca--> </div>
    </div>

<?php } ?>

<!-- ****************************MODAL DE DETALLE ************************************************ -->
<div id="Modal_detalle" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" style="z-index: 9999999999 !important;">
    <div class="col-md-12">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">X</button>
                <h3 class="modal-title" id="title_modal" align="center"></h3>
            </div>
            <div>
                <div class="modal-body">
                    <form class="well form-horizontal" id="formModal_detalle" action=""  method="post">
                        <fieldset>
                            <!-- PRIMERA SESSION -->
                            <fieldset class="col-md-3 sessionmodal">

                                <div class="form-group col-md-12">
                                    <label for="id_cliente_onyx" class="col-md-12 control-label ubicacionLetra" >ID Cliente Onyx: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="k_id_estado_ot" id="mdl_k_id_estado_ot" class="form-control ubicacionLetra"disabled="true" type="text" required >
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="nombre_cliente" class="col-md-12 control-label ubicacionLetra">Nombre Cliente: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group ubicacionLetra">
                                            <textarea name="nombre_cliente" id="mdl_nombre_cliente" rows="1" cols="29" class="form-control csstextarea tamanioletra" disabled="true">
                                            </textarea>
                                            <!-- <input name="nombre_cliente" id="mdl_nombre_cliente" class="form-control"  disabled="true" type="text" required> -->
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="grupo_objetivo" class="col-md-12 control-label ubicacionLetra" >Grupo Objetivo: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="grupo_objetivo" id="mdl_grupo_objetivo" class="form-control tamanioletra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div> 

                                <div class="form-group col-md-12">
                                    <label for="segmento" class="col-md-12 control-label ubicacionLetra">Segmento: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="segmento" id="mdl_segmento" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="nivel_atencion" class="col-md-12 control-label ubicacionLetra" style="text-align: left;" >Nivel atención: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="nivel_atencion" id="mdl_nivel_atencion" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="ciudad" class="col-md-12 control-label ubicacionLetra" style="text-align: left;" >Ciudad: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="ciudad" id="mdl_ciudad" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="departamento" class="col-md-12 control-label ubicacionLetra" style="text-align: left;" >Departamento: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="departamento" id="mdl_departamento" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div> 

                                <div class="form-group col-md-12">
                                    <label for="grupo" class="col-md-12 control-label ubicacionLetra">Grupo: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <textarea name="grupo" id="mdl_grupo" rows="1" cols="29" class="form-control csstextarea ubicacionLetra" disabled="true">
                                            </textarea>
                                            <!-- <input name="grupo" id="grupo" class="form-control" minlength="3" disabled="true" type="text" required> -->
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="consultor_comercial" class="col-md-12 control-label ubicacionLetra">Consultor Comercial: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <textarea name="consultor_comercial" id="mdl_consultor_comercial" rows="1" cols="29" class="form-control csstextarea tamanioletra" disabled="true">
                                            </textarea>
                                            <!-- <input name="consultor_comercial" id="mdl_consultor_comercial" class="form-control" disabled="true"  minlength="3" type="text" required> -->
                                        </div>
                                    </div>
                                </div> 

                                <div class="form-group col-md-12">
                                    <label for="grupo2" class="col-md-12 control-label ubicacionLetra">Grupo 2: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="grupo2" id="mdl_grupo2" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="consultor_postventa" class="col-md-12 control-label ubicacionLetra">Consultor Postventa: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="consultor_postventa" id="mdl_consultor_postventa" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div> 

                                <div class="form-group col-md-12">
                                    <label for="proy_instalacion" class="col-md-12 control-label ubicacionLetra">Proy. Instalación: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <textarea name="proy_instalacion" id="mdl_proy_instalacion" rows="1" cols="29" class="form-control csstextarea tamanioletra" disabled="true">
                                            </textarea>
                                            <!-- <input name="proy_instalacion" id="proy_instalacion" class="form-control" minlength="3" disabled="true" type="text" required> -->
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group col-md-12">
                                    <label for="ing_responsable" class="col-md-12 control-label ubicacionLetra">Ing. Responsable: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="ing_responsable" id="mdl_ing_responsable" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div> 

                                <div class="form-group col-md-12">
                                    <label for="id_enlace" class="col-md-12 control-label ubicacionLetra">ID Enlace: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="id_enlace" id="mdl_id_enlace" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="alias_enlace" class="col-md-12 control-label ubicacionLetra">Alias Enlace: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">                                           
                                            <textarea name="alias_enlace" id="mdl_alias_enlace" rows="2" cols="29" class="form-control csstextarea tamanioletra" disabled="true">
                                            </textarea>
                                            <!-- <input name="alias_enlace" id="mdl_alias_enlace" class="form-control" minlength="3" disabled="true" type="text" required> -->
                                        </div>
                                    </div>
                                </div>

                            </fieldset>


                            <!-- SEGUNDA SESSION -->
                            <fieldset class="col-md-3 sessionmodal" x;">


                                      <div class="form-group col-md-12">
                                    <label for="orden_trabajo" class="col-md-12 control-label ubicacionLetra">Orden Trabajo: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <textarea name="orden_trabajo" id="mdl_orden_trabajo" rows="1" cols="29" class="form-control csstextarea tamanioletra" disabled="true">
                                            </textarea>
                                            <!-- <input name="orden_trabajo" id="mdl_orden_trabajo" class="form-control" minlength="3" disabled="true" type="text" required> -->
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="nro_ot_onyx" class="col-md-12 control-label ubicacionLetra">Num. Ot Onyx: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="nro_ot_onyx" id="mdl_nro_ot_onyx" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div> 

                                <div class="form-group col-md-12">
                                    <label for="servicio" class="col-md-12 control-label ubicacionLetra">Servicio: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <textarea name="servicio" id="mdl_servicio" rows="1" cols="29" class="form-control csstextarea tamanioletra" disabled="true">
                                            </textarea>
                                            <!-- <input name="servicio" id="mdl_servicio" class="form-control" minlength="3" disabled="true" type="text" required> -->
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="familia" class="col-md-12 control-label ubicacionLetra">Familia: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="familia" id="mdl_familia" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div> 

                                <div class="form-group col-md-12">
                                    <label for="producto" class="col-md-12 control-label ubicacionLetra">Producto: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="producto" id="mdl_producto" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="fecha_creacion" class="col-md-12 control-label ubicacionLetra">Fecha creación: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="fecha_creacion" id="mdl_fecha_creacion" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div> 

                                <div class="form-group col-md-12">
                                    <label for="tiempo_incidente" class="col-md-12 control-label ubicacionLetra">Tiempo Incidente: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="tiempo_incidente" id="mdl_tiempo_incidente" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="estado_orden_trabajo" class="col-md-12 control-label ubicacionLetra">Estado Orden Trabajo: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="estado_orden_trabajo" id="mdl_estado_orden_trabajo" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div> 

                                <div class="form-group col-md-12">
                                    <label for="tiempo_estado" class="col-md-12 control-label ubicacionLetra">Tiempo Estado: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="tiempo_estado" id="mdl_tiempo_estado" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="ano_ingreso_estado" class="col-md-12 control-label ubicacionLetra">Año Ingreso Estado: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="ano_ingreso_estado" id="mdl_ano_ingreso_estado" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="mes_ngreso_estado" class="col-md-12 control-label ubicacionLetra">Mes Ingreso Estado: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="mes_ngreso_estado" id="mdl_mes_ngreso_estado" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="fecha_ingreso_estado" class="col-md-12 control-label ubicacionLetra">Fecha Ingreso Estado: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">                                         
                                            <input name="fecha_ingreso_estado" id="mdl_fecha_ingreso_estado" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div> 

                                <div class="form-group col-md-12">
                                    <label for="usuario_asignado" class="col-md-12 control-label ubicacionLetra">Usuario Asignado: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <textarea name="usuario_asignado" id="mdl_usuario_asignado" rows="2" cols="29" class="form-control csstextarea tamanioletra" disabled="true">
                                            </textarea>
                                           <!--  <input name="usuario_asignado" id="mdl_usuario_asignado" class="form-control" minlength="5" disabled="true" type="text" required> -->
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="grupo_asignado" class="col-md-12 control-label ubicacionLetra">Grupo Asignado: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">                                           
                                            <input name="grupo_asignado" id="mdl_grupo_asignado" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="ingeniero_provisioning" class="col-md-12 control-label ubicacionLetra">Ingeniero Provisioning: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">  
                                            <textarea name="ingeniero_provisioning" id="mdl_ingeniero_provisioning" rows="1" cols="29" class="form-control csstextarea tamanioletra" disabled="true">
                                            </textarea>
                                            <!-- <input name="ingeniero_provisioning" id="mdl_ingeniero_provisioning" class="form-control" minlength="3" disabled="true" type="text" required>-->
                                        </div> 
                                    </div>
                                </div>


                            </fieldset>

                            <!-- TERCERA SESSION -->
                            <fieldset class="col-md-3 sessionmodal" x;">


                                      <div class="form-group col-md-12">
                                    <label for="cargo_arriendo" class="col-md-12 control-label ubicacionLetra">Cargo Arriendo: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="cargo_arriendo" id="mdl_cargo_arriendo" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div> 

                                <div class="form-group col-md-12">
                                    <label for="cargo_mensual" class="col-md-12 control-label ubicacionLetra">Cargo Mensual: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="cargo_mensual" id="mdl_cargo_mensual" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="monto_moneda_local_arriendo" class="col-md-12 control-label ubicacionLetra">Monto Moneda Local Arriendo: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="monto_moneda_local_arriendo" id="mdl_monto_moneda_local_arriendo" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div> 

                                <div class="form-group col-md-12">
                                    <label for="monto_moneda_local_cargo_mensual" class="col-md-12 control-label ubicacionLetra">Monto Moneda Local Cargo Mensual: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="monto_moneda_local_cargo_mensual" id="mdl_monto_moneda_local_cargo_mensual" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="cargo_obra_civil" class="col-md-12 control-label ubicacionLetra">Cargo Obra Civil: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="cargo_obra_civil" id="mdl_cargo_obra_civil" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div> 

                                <div class="form-group col-md-12">
                                    <label for="descripcion" class="col-md-12 control-label ubicacionLetra">Descripción: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <textarea name="descripcion" id="mdl_descripcion" rows="4" cols="29" class="form-control csstextarea tamanioletra" disabled="true">
                                            </textarea>
                                            <!-- <input name="descripcion" id="mdl_descripcion" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required> -->
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="direccion_origen" class="col-md-12 control-label ubicacionLetra">Dirección Origen: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <textarea name="direccion_origen" id="mdl_direccion_origen" rows="3" cols="29" class="form-control csstextarea tamanioletra" disabled="true">
                                            </textarea>
                                            <!-- <input name="direccion_origen" id="mdl_direccion_origen" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required> -->
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="ciudad_incidente" class="col-md-12 control-label ubicacionLetra">Ciudad Incidente: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="ciudad_incidente" id="mdl_ciudad_incidente" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="direccion_destino" class="col-md-12 control-label ubicacionLetra">Dirección Destino: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">  
                                            <textarea name="direccion_destino" id="mdl_direccion_destino" rows="1" cols="29" class="form-control csstextarea tamanioletra" disabled="true">
                                            </textarea>                                
                                            <!-- <input name="direccion_destino" id="mdl_direccion_destino" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required> -->
                                        </div>
                                    </div>
                                </div> 

                                <div class="form-group col-md-12">
                                    <label for="ciudad_incidente3" class="col-md-12 control-label ubicacionLetra">Ciudad Incidente 3: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="ciudad_incidente3" id="mdl_ciudad_incidente3" class="form-control ubicacionLetra" minlength="5" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="fecha_compromiso" class="col-md-12 control-label ubicacionLetra">Fecha Compromiso: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">                                           
                                            <input name="fecha_compromiso" id="mdl_fecha_compromiso" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="fecha_programacion" class="col-md-12 control-label ubicacionLetra">Fecha Programación: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">                                           
                                            <input name="fecha_programacion" id="mdl_fecha_programacion" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="fecha_realizacion" class="col-md-12 control-label ubicacionLetra">Fecha Realización: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="fecha_realizacion" id="mdl_fecha_realizacion" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div> 

                                <div class="form-group col-md-12">
                                    <label for="resolucion_1" class="col-md-12 control-label ubicacionLetra">Resolución 1: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="resolucion_1" id="mdl_resolucion_1" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div>

                            </fieldset>

                            <!-- CUARTA SESSION -->
                            <fieldset class="col-md-3 sessionmodal" >


                                <div class="form-group col-md-12">
                                    <label for="resolucion_2" class="col-md-12 control-label ubicacionLetra">Resolución 2: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <textarea name="resolucion_2" id="mdl_resolucion_2" rows="1" cols="29" class="form-control csstextarea tamanioletra" disabled="true">
                                            </textarea>     
                                            <!-- <input name="resolucion_2" id="mdl_resolucion_2" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required> -->
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="resolucion_3" class="col-md-12 control-label ubicacionLetra">Resolución 3: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <textarea name="resolucion_3" id="mdl_resolucion_3" rows="1" cols="29" class="form-control csstextarea tamanioletra" disabled="true">
                                            </textarea>     
                                            <!-- <input name="resolucion_3" id="mdl_resolucion_3" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required> -->
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="resolucion_4" class="col-md-12 control-label ubicacionLetra">Resolución 4: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <textarea name="resolucion_4" id="mdl_resolucion_4" rows="1" cols="29" class="form-control csstextarea tamanioletra" disabled="true">
                                            </textarea>     
                                            <!-- <input name="resolucion_4" id="mdl_resolucion_4" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required> -->
                                        </div>
                                    </div>
                                </div> 

                                <div class="form-group col-md-12">
                                    <label for="ot_hija" class="col-md-12 control-label ubicacionLetra">OT Hija: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="ot_hija" id="mdl_ot_hija" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="estado_orden_trabajo_hija" class="col-md-12 control-label ubicacionLetra">Estado Orden Trabajo Hija: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="estado_orden_trabajo_hija" id="mdl_estado_orden_trabajo_hija" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div> 

                                <div class="form-group col-md-12">
                                    <label for="fecha_creacion_ot_hija" class="col-md-12 control-label ubicacionLetra">Fecha creacion OT Hija: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="fecha_creacion_ot_hija" id="mdl_fecha_creacion_ot_hija" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="proveedor_ultima_milla" class="col-md-12 control-label ubicacionLetra">Proveedor Ultima Milla: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <textarea name="proveedor_ultima_milla" id="mdl_proveedor_ultima_milla" rows="1" cols="29" class="form-control csstextarea tamanioletra" disabled="true">
                                            </textarea>   
                                            <!-- <input name="proveedor_ultima_milla" id="mdl_proveedor_ultima_milla" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required> -->
                                        </div>
                                    </div>
                                </div> 

                                <div class="form-group col-md-12">
                                    <label for="estado_orden_trabajo_hija" class="col-md-12 control-label ubicacionLetra">Estado Orden Trabajo Hija: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <textarea name="estado_orden_trabajo_hija" id="mdl_estado_orden_trabajo_hija" rows="1" cols="29" class="form-control csstextarea tamanioletra" disabled="true">
                                            </textarea>  
                                            <!-- <input name="estado_orden_trabajo_hija" id="mdl_estado_orden_trabajo_hija"  class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required> -->
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="usuario_asignado4" class="col-md-12 control-label ubicacionLetra">Usuario Asignado 4: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">                                         
                                            <textarea name="usuario_asignado4" id="mdl_usuario_asignado4" rows="1" cols="29" class="form-control csstextarea tamanioletra" disabled="true">
                                            </textarea>  
                                            <!-- <input name="usuario_asignado4" id="mdl_usuario_asignado4" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required> -->
                                        </div>
                                    </div>
                                </div> 

                                <div class="form-group col-md-12">
                                    <label for="resolucion_15" class="col-md-12 control-label ubicacionLetra">Resolución 15: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <textarea name="resolucion_15" id="mdl_resolucion_15" rows="1" cols="29" class="form-control csstextarea tamanioletra" disabled="true">
                                            </textarea>  
                                            <!-- <input name="resolucion_15" id="mdl_resolucion_15" class="form-control ubicacionLetra" minlength="5" disabled="true" type="text" required> -->
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="resolucion_26" class="col-md-12 control-label ubicacionLetra">Resolución 26: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <textarea name="resolucion_26" id="mdl_resolucion_26" rows="1" cols="29" class="form-control csstextarea tamanioletra" disabled="true">
                                            </textarea>  
                                            <!-- <input name="resolucion_26" id="mdl_resolucion_26" class="form-control ubicacionLetra" minlength="5" disabled="true" type="text" required> -->
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="resolucion_37" class="col-md-12 control-label ubicacionLetra">Resolución 37: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <textarea name="resolucion_37" id="mdl_resolucion_37" rows="1" cols="29" class="form-control csstextarea tamanioletra" disabled="true">
                                            </textarea>  
                                            <!-- <input name="resolucion_37" id="mdl_resolucion_37" class="form-control ubicacionLetra" minlength="5" disabled="true" type="text" required> -->
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="resolucion_48" class="col-md-12 control-label ubicacionLetra">Resolución 48: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <textarea name="resolucion_48" id="mdl_resolucion_48" rows="1" cols="29" class="form-control csstextarea tamanioletra" disabled="true">
                                            </textarea>  <!-- <input name="resolucion_48" id="mdl_resolucion_48" class="form-control ubicacionLetra" minlength="5" disabled="true" type="text" required> -->
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="fec_actualizacion_onyx_hija" class="col-md-12 control-label ubicacionLetra">Fecha Actualización Onyx Hija: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="fec_actualizacion_onyx_hija" id="mdl_fec_actualizacion_onyx_hija"  class="form-control ubicacionLetra" minlength="5" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="Tipo_transcurrido" class="col-md-12 control-label ubicacionLetra">Tiempo transcurrido: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="Tipo_transcurrido" id="mdl_Tipo_transcurrido"  class="form-control ubicacionLetra" minlength="5" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div>

                            </fieldset>

                        </fieldset>
                    </form>
                </div>            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" id=CerrarModalDetalle" data-dismiss="modal"><i class='glyphicon glyphicon-remove'></i>&nbsp;Cerrar</button>
            </div>
        </div>
    </div> 
</div>

<!-- ****************************MODAL DE DETALLE RESUMEN FUERA DE TIEMPO************************************************ -->
<div id="Modal_detalle_res_out" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" >
    <div class="col-md-12">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">X</button>
                <h3 class="modal-title" id="title_modal" align="center"></h3>
            </div>
            <div>
                <div class="modal-body">
                    <h3>Fuera de Tiempos</h3>
                    <table id="tablaDetalleResOutTimes" class="table table-hover table-bordered table-striped dataTable_camilo" width="100%"></table>
                </div>            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" id=CerrarModalDetalle" data-dismiss="modal"><i class='glyphicon glyphicon-remove'></i>&nbsp;Cerrar</button>
            </div>
        </div>
    </div> 
</div>

<!-- ****************************MODAL DE DETALLE RESUMEN EN TIEMPO************************************************ -->
<div id="Modal_detalle_res_in" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" >
    <div class="col-md-12">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">X</button>
                <h3 class="modal-title" id="title_modal" align="center"></h3>
            </div>
            <div>
                <div class="modal-body">
                    <h3>En Tiempos</h3>
                    <table id="tablaDetalleResInTimes" class="table table-hover table-bordered table-striped dataTable_camilo" width="100%"></table>
                </div>            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" id=CerrarModalDetalle" data-dismiss="modal"><i class='glyphicon glyphicon-remove'></i>&nbsp;Cerrar</button>
            </div>
        </div>
    </div> 
</div>
