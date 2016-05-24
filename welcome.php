<div id="welcomebox">
    <div id="registerbox">
        <h2>注册</h2>
        <b>创建账户</b>

        <form method="POST" action="register.php">
            <table>
                <tr>
                    <td>用户名</td>
                    <td><input type="text" name="username"></td>
                </tr>
                <tr>
                    <td>密码</td>
                    <td><input type="password" name="password"></td>
                </tr>
                <tr>
                    <td>确认密码</td>
                    <td><input type="password" name="password2"></td>
                </tr>
                <tr>
                    <td colspan="2" align="right"><input type="submit" name="doit" value="注册"></td>
                </tr>
            </table>
        </form>
        <h2>已有账户？点此登录</h2>

        <form method="POST" action="login.php">
            <table>
                <tr>
                    <td>用户名</td>
                    <td><input type="text" name="username"></td>
                </tr>
                <tr>
                    <td>密码</td>
                    <td><input type="password" name="password"></td>
                </tr>
                <tr>
                    <td colspan="2" align="right"><input type="submit" name="doit" value="登录"></td>
                </tr>
            </table>
        </form>
    </div>
</div>
