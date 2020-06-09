<html>
    <body>
    <form action="{{ url('/brand') }}" method="POST">
            <table>
                <tr>
                    <th>Brand</th>
                </tr>
                <tr>
                    {{csrf_field()}}
                    <td>
                        Brand Name
                    </td>
                    <td>
                        <input type="text" name="BrandName">
                    </td>
                </tr>
                <tr>
                    <td>
                        Tier
                    </td>
                    <td>
                        <select name="Tier" id="">
                            <option value="1">
                                Low
                            </option>
                            <option value="2">
                                Medium
                            </option>
                            <option value="3">
                                High
                            </option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        Origin
                    </td>
                    <td>
                        <input type="text" name="Origin">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" name="submit">
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>