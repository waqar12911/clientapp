                               <table id="myTable" class="text-primary display table tablesorter">
                                <thead class="text-primary">
                                <tr>
                                    <th scope="col" style="white-space: nowrap; "><input type="checkbox" class="hideAllCheckBox" name="all" id="checkall" />Check All</th>
                                    <th scope="col">label</th>
                                    <th scope="col">Transaction Description</th>
                                    <th scope="col">conversion rate</th>
                                    <th scope="col">BTC</th>
                                    <th scope="col">USD</th>
                                    <th scope="col">payment hash</th>
                                    <th scope="col">payment preimage</th>
                                    <th scope="col">status</th>
                                    <th scope="col">satoshi</th>
                                    <th scope="col">destination</th>
                                    <!--<th scope="col">Transection time stamp</th>-->
                                    <th>Created at</th>
                                </tr></thead>
                                <tbody id="merchantBody">
                                @foreach($data as $datum)
                                    <tr class="custom_color" >
                                        <!--<td> <a href="javascriptvoid:(0)" data-toggle="modal" data-target="#checkModal" class=""> <input type="checkbox"> {{$datum->transaction_id}}</a></td>-->
                                        <!--{{$datum->payment_hash}}-->
                                        <!--{{$datum->destination}}-->
                                        <td><input type="checkbox" class="cb-element hideAllCheckBox" name="dataEmail[]" value="{{$datum->id}}" /></td>
                                        <td>{{$datum->transaction_label}}</td>
                                        <td>{{$datum->description}}</td>
                                        <td>{{$datum->conversion_rate}}</td>
                                        <td >{{$datum->transaction_amountBTC}}</td>
                                        <td >{{$datum->transaction_amountUSD}}</td>
                                        <td><div  class="style_prevu_kit">{!! \QrCode::size(100)->generate($datum->payment_hash); !!}</div></td>
                                        <td><div  class="style_prevu_kit">{!! \QrCode::size(100)->generate($datum->payment_preimage); !!}</div></td>
                                        <td>{{$datum->status}}</td>
                                        <td>{{$datum->msatoshi}}</td>
                                        <td><div  class="style_prevu_kit">{!! \QrCode::size(100)->generate($datum->destination); !!}</div></td>
                                        <!--<td>{{$datum->transaction_timestamp}}</td>-->
                                        <td>{{$datum->created_at}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>