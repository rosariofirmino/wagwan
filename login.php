#!/usr/local/bin/php
<html>

<head>
    <title>Wagwan Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./styles.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

</head>
<?php

?>

<body>
    <div className="container">
        <div className="row justify-content-center">
            <div className="col-md-6">
                <h1 className="text-center mb-4">Signup Page</h1>
                <form onSubmit={handleSignUp}>
                    <div className="form-group">
                        <label htmlFor="email">Email:</label>
                        <input type="text" id="email" className="form-control" value={email} onChange={} />
                    </div>
                    <div className="form-group">
                        <label htmlFor="username">Username:</label>
                        <input type="text" id="username" className="form-control" value={username} onChange={} />
                    </div>
                    <div className="form-group">
                        <label htmlFor="password">Password:</label>
                        <input type="password" id="password" className="form-control" value={password} onChange={} />
                    </div>
                    <div className="form-group">
                        <label htmlFor="confirmPassword">Confirm Password:</label>
                        <input type="password" id="confirmPassword" className="form-control" value={confirmPassword}
                            onChange={} />
                    </div>
                    <button type="submit" className="btn btn-secondary btn-block">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>