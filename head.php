<!DOCTYPE html>
<html>
<head>
	<title>PHP Test</title>
</head>
<style type="text/css">
	body {
		-webkit-font-smoothing: antialiased;
		font-family: 'Helvetica Neue', sans-serif;
	}
	td {
		padding: 5px 10px;
	}
	tr:nth-child(odd) {
		font-size: 14px;
		background: #f2f2f2;
	}
	tr:first-of-type {
        color: #fff;
		font-size: 18px;
		font-weight: 700;
		background: #1E3C71;
		letter-spacing: 0.5px;
	}
    tr:first-of-type a {
        color: #fff;
    }
	form {
		float: left;
		width: 320px;
	}
	table {
		float: left;
		max-width: 500px;
	}
    select,
    option{
        width: 100%;
    }
	.block-head {
		width: 100%;
		color: #fff;
		font-weight: 700;
		padding: 5px 10px;
		text-align: center;
		background: #1E3C71;
		margin-top: 2px;
		box-sizing: border-box;
	}
	.form-body {
		padding: 15px 20px;
		background: #f2f2f2;
	}
	label,
	input {
		display: block;
	}
	label {
		margin-bottom: 8px;
	}
	input {
		color: #222;
		width: 100%;
		height: 25px;
		font-size: 14px;
		border-radius: 3px;
		text-indent: 5px;
		border-color: transparent;
		font-family: 'Helvetica Neue', sans-serif;
	}
	.form-field {
		margin-bottom: 20px;
	}
    #add-team-form {
        margin: 0 50px;
    }
	.btn {
		border: 0;
		color: #fff;
		padding: 10px;
		font-size: 14px;
		font-weight: 700;
		text-align: center;
		background: #1E3C71;
		cursor: pointer;
		display: block;
		min-width: 110px;
		word-break: none;
		transition: all .3s ease;
		text-decoration: none;
		font-family: 'Helvetica Neue', sans-serif;
	}
	.btn:hover {
		background: #132749;
	}
	.btn.alt {
		background: #D50A0A;
	}
	.btn.alt:hover {
		background: #a50707;
	}
	.block-head h1	{
		margin: 0;
		font-size: 18px;
	}
	.form-footer-btn {
		width: 100%;
	    color: #fff;
	    outline: 0;
	    border: 0;
	    cursor: pointer;
	    font-size: 18px;
	    font-weight: 700;
	    padding: 15px 10px;
	    text-align: center;
	    background: #1E3C71;
	    margin-top: 2px;
	    box-sizing: border-box;
	}
	.page-title {
		color: #D50A0A;
		padding-left: 2px;
		margin-bottom: 15px;
	}
	.alert {
		margin: 10px 0;
		font-size: 14px;
		min-width: 200px;
		padding: 8px 10px;
		border-radius: 3px;
		transition: all .3s ease;
	}
	.alert-success {
		background: lightgreen;
		border: 2px solid green;
	}
	.alert-warning {
		background: lightpink;
		border: 2px solid red;
	}
    .info {
        width: 400px;
        float: left;
    }
    .info p {
        font-size: 16px;
        line-height: 26px;
        padding-left: 5px;
        color: dimgrey;
    }
</style>
<body>