
            <?php
include('../../MySql.php');
            $prefix = '<div class="tabela_father">
            <div class="tabela_header">
                <i class="fa-solid fa-angle-left"></i> <span>Vendas no dia: <yellow>20/07/2023</yellow></span><i class="fa-solid fa-angle-right"></i>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Podium</th>
                        <th>Produto</th>
                        <th>Quantidade de Vendas</th>
                        <th>Valor Uni</th>
                        <th>Valor total de Vendas</th>
                    </tr>
                </thead>
                <tbody>';
            $row = \MySql::conectar()->prepare("SELECT p.nome, p.preco, vendas_contadas.ordem, vendas_contadas.total_vendas
            FROM tb_produtos p
            INNER JOIN (
                SELECT produto, COUNT(*) as total_vendas,
                       ROW_NUMBER() OVER (ORDER BY COUNT(*) DESC) AS ordem
                FROM tb_vendas
                WHERE date(data) BETWEEN ? AND ?
                GROUP BY produto
            ) vendas_contadas
            ON p.id = vendas_contadas.produto
            ORDER BY vendas_contadas.total_vendas DESC;");
            $row->execute(array($_POST['data_min'],$_POST['data_max']));
            $row = $row->fetchAll();
            foreach ($row as $key => $value) {
            $trocando_virgula = str_replace(',','.',$value['preco']);

                if(isset($_POST['switch'])){
                    $prefix .="
                    <tr>
                    <td>".$value['ordem']."#</td>
                     <td>".$value['nome']."</td>
                     <td >".$value['total_vendas']."</td>
                     <td>R$".$value['preco']."</td>
                     <td>R$".str_replace('.',',',number_format($trocando_virgula *$value['total_vendas'], 2)) ."</td>

                     </tr>";
                }else{
                    echo "
                    <tr>
                    <td>".$value['ordem']."#</td>
                     <td>".$value['nome']."</td>
                     <td >".$value['total_vendas']."</td>
                     <td>R$".$value['preco']."</td>
                     <td>R$".str_replace('.',',',number_format($trocando_virgula *$value['total_vendas'], 2)) ."</td>

                     </tr>";
                }
                  
             
            
            }
            if(isset($_POST['switch'])){
                echo $prefix."            </tr>
                </tbody>
            </table>
        </div>";
            }
            ?>
