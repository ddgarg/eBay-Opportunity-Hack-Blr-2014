package com.rangde.dbutil;

import java.io.BufferedReader;
import java.io.FileNotFoundException;
import java.io.IOException;
import java.io.InputStreamReader;
import java.sql.Connection;
import java.sql.DatabaseMetaData;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.List;

public class H2Connector {
	
	private static Connection connection;
	
	public static Connection getConnection(){
		if (connection == null) {
			try{
				Class.forName("org.h2.Driver");
		        connection = DriverManager.
		            getConnection("jdbc:h2:~/test2", "sa", "");
			} catch(Exception e) {
				e.printStackTrace();
			}
		}
		return connection;
	}
	
	public static void closeConnection() {
		if(connection != null) {
			try {
				connection.close();
				connection = null;
			} catch (SQLException e) {
				e.printStackTrace();
			}
		}
	}
	
	public static void main2(String[] args){
		Connection connection = getConnection();
		try {
			DatabaseMetaData metadata = connection.getMetaData();
			ResultSet resultSet;
			resultSet = metadata.getTables(null, null, "MYTABLE", null);
			Statement statement = connection.createStatement();
			if(!resultSet.next()){
				//Create table
				String sql = "CREATE TABLE MYTABLE (NAME VARCHAR(20))";
				statement.execute(sql);
			} else {
				String sql = "INSERT INTO MYTABLE (NAME) VALUES ('hello')";
				statement.executeUpdate(sql);
			}
			
			//Lets check count!
			String sql = "SELECT COUNT(*) AS NO_OF_ROWS FROM MYTABLE";
			resultSet = statement.executeQuery(sql);
			Integer noOfRows = 0;
			while (resultSet.next()) {
				noOfRows = resultSet.getInt("NO_OF_ROWS");
			}
			System.out.println("No. of rows in MyTable: " + noOfRows);
		} catch(Exception e) {
			e.printStackTrace();
		}
		closeConnection();
	}
	
	public static void main(String[] args){
		initH2();
		seedH2();
	}
	
	public static void initH2() {
		List<String> sqls = new ArrayList<String>();
		String sql = "";
		try {
	        BufferedReader reader = new BufferedReader(new InputStreamReader(H2Connector.class.getClassLoader().getResourceAsStream("DDL.sql")));
	        String line;
	        while ((line = reader.readLine()) != null) {
	        	//System.out.println(line);
	        	if (line.equals("") && !sql.equals("")) {
	        		sqls.add(sql);
	        		sql = "";
	        	} else {
	        		sql = sql + line;
	        	}
	        }
	        if (!sql.equals(""))
	        	sqls.add(sql);
	        
	    } catch (FileNotFoundException e) {
	        e.printStackTrace();
	    } catch (IOException e) {
	        e.printStackTrace();
	    }
		
		for(String s: sqls){
			System.out.println("Processing sql: " + s);
			createTable(s);
		}
	}

	private static void createTable(String s) {
		int endIdx = s.indexOf("(");
		String tableName = s.substring(13, endIdx - 1);
		System.out.println("Table name:" + tableName);
		getConnection();
		try {
			DatabaseMetaData metadata = connection.getMetaData();
			ResultSet resultSet;
			resultSet = metadata.getTables(null, null, tableName.toUpperCase(), null);
			Statement statement = connection.createStatement();
			if(!resultSet.next()){
				System.out.println("Table not exists, going to create.");
				//Create table
				statement.execute(s);
			} else {
				System.out.println("Table exists!");
			}
		} catch(Exception e){e.printStackTrace();}
		closeConnection();
	}
	
	public static void seedH2() {
		List<String> sqls = new ArrayList<String>();
		String sql = "";
		try {
	        BufferedReader reader = new BufferedReader(new InputStreamReader(H2Connector.class.getClassLoader().getResourceAsStream("INSERT.sql")));
	        String line;
	        while ((line = reader.readLine()) != null) {
	        	//System.out.println(line);
	        	if (line.equals("") && !sql.equals("")) {
	        		sqls.add(sql);
	        		sql = "";
	        	} else {
	        		sql = sql + line;
	        	}
	        }
	        if (!sql.equals(""))
	        	sqls.add(sql);
	        
	    } catch (FileNotFoundException e) {
	        e.printStackTrace();
	    } catch (IOException e) {
	        e.printStackTrace();
	    }
		
		for(String s: sqls){
			System.out.println("Running query: " + s);
			if (s.startsWith("#"))
				continue;
			getConnection();
			try {
				Statement statement = connection.createStatement();
				statement.execute(s);
			} catch(Exception e){e.printStackTrace();}
			closeConnection();
		}
	}

}
