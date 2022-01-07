                            <table id="myTable" class="text-primary display table tablesorter">
                                <thead class="text-primary">
                                <tr>
                                    <th scope="col" style="white-space: nowrap; "><input type="checkbox" name="all" id="checkall" />Check All</th>
                                    <th scope="col">Id</th>
                                    <th scope="col">label</th>
                                    <th scope="col">BTC</th>
                                    <th scope="col">USD</th>

                                    <th scope="col">Created at </th>
                                </tr></thead>
                                <tbody>
                                @foreach($data as $datum)
                                    <tr class="custom_color" >
                                        <td><input type="checkbox" class="cb-element" /></td>
                                        <td>{{$datum->transaction_id}}</td>
                                        <td>{{$datum->transaction_label}}</td>
                                        <td >{{$datum->transaction_amountBTC}}</td>
                                        <td >{{$datum->transaction_amountUSD}}</td>
                                        <td>{{$datum->transaction_timestamp}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>