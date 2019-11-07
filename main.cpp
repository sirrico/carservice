#include <iostream>
#include <iomanip>
#include <fstream>
#include <string>
#include <cstddef>      
#include <stdio.h>
#include <sqlite3.h>   

using namespace std;    

static int callback(void *NotUsed, int argc, char **argv, char **azColName) {
   int i;
   for(i = 0; i<argc; i++) {
      printf("%s = %s\n", azColName[i], argv[i] ? argv[i] : "NULL");
   }
   printf("\n");
   return 0;
}

int main(int argc, char** argv) 
{ 
    sqlite3* DB; 
    int input;
    int exit = 0; 
    int id;
    int temp;
    string temp2;
    ifstream input_file("id.txt");
    int tempVar;
    while (input_file >> tempVar)
    {
        id = tempVar;
    }
    input_file.close();
    cout << id << endl;

    string t1;
    string t2;
    string t3;
    int priority;
    exit = sqlite3_open("data.db", &DB); 
    string sql = "CREATE TABLE TICKETS("  \
      "ID INT PRIMARY KEY     NOT NULL," \
      "TITLE           char(100)    NOT NULL," \
      "DESCRIPTION            char(1000)     NOT NULL," \
      "COMPUTER        CHAR(30)," \
      "PRIORITY         INT," \
      "STATUS        CHAR(3000));";
    char* messaggeError; 
    const char* data = "Callback function called";
  
    if (exit) { 
        cerr << "Error open DB " << sqlite3_errmsg(DB) << endl; 
        return (-1); 
    } 
    else
        cout << "Opened Database Successfully!" << endl; 

    cout << "Checking main table...";
    exit = sqlite3_exec(DB, sql.c_str(), NULL, 0, &messaggeError); 

    if (exit != SQLITE_OK) { 
        cerr << "Error Create Table, already exists?" << endl; 
        sqlite3_free(messaggeError); 
    } 
    else
        cout << "Table created Successfully" << endl; 
    
    cout << "Starting main program..." << endl;

    while(input != 5){

    cout << endl << endl;
    cout << "--------------------------------------------------" << endl;
    cout << "IT TICKETING SOFTWARE" << endl;
    cout << "1. Add a new ticket" << endl;
    cout << "2. View tickets" << endl;
    cout << "3. Add comments to ticket" << endl;
    cout << "4. Execute SQL statement" << endl;
    cout << "5. Exit program" << endl << endl;
    while (input != 1 && input != 2 && input != 3 && input != 4 && input != 5){
        cout << "Input: ";
        cin >> input;
        cin.ignore();
    }

    if (input == 1){
        input = 0;
        cout << endl;
        cout << "--------------------------------------------------" << endl;
        cout << "Add a new ticket:" << endl;
        cout << "ID: " << endl << id+1 << endl;
        cout << "Title: " << endl;
        getline(cin, t1);
        cout << "Description: " << endl;
        getline(cin, t2);
        cout << "Computer: " << endl;
        getline(cin, t3);
        cout << "Priority (1-5): " << endl;
        cin >> priority;
        cout << endl << "Creating entry...";
        sql = "INSERT INTO TICKETS (ID,TITLE,DESCRIPTION,COMPUTER,PRIORITY,STATUS) "  \
         "VALUES (" + to_string(id + 1) + ",'" + t1 + "','" + t2 + "','" + t3 + "'," + to_string(priority) + ",''); ";
        cout << endl << sql << endl;

        exit = sqlite3_exec(DB, sql.c_str(), NULL, 0, &messaggeError); 

        if (exit != SQLITE_OK) { 
            cerr << "Error creating ticket" << endl; 
            sqlite3_free(messaggeError); 
        } 
        else{
            cout << "Ticket added Successfully" << endl;     
            id++;
        }
    }

    if(input == 2){
        input = 0;
        sql = "SELECT * from TICKETS";
        exit = sqlite3_exec(DB, sql.c_str(), callback, (void*)data, &messaggeError); 
        cout << sql << endl;

        if (exit != SQLITE_OK) { 
            cerr << "Error running command" << endl; 
            sqlite3_free(messaggeError); 
        } 
        else
            cout << "Command output complete" << endl; 
    }

    if(input == 3){
        input = 0;
        cout << "Ticket to add comments: ";
        cin >> temp;
        cin.ignore();
        cout << "Comments: " << endl;
        getline(cin,temp2);
        sql = "UPDATE TICKETS SET STATUS = '" + temp2 + "' WHERE ID = " + to_string(temp);
        cout << endl << sql << endl;

        exit = sqlite3_exec(DB, sql.c_str(), NULL, 0, &messaggeError); 

        if (exit != SQLITE_OK) { 
            cerr << "Error updating ticket" << endl; 
            sqlite3_free(messaggeError); 
        } 
        else{
            cout << "Ticket updated Successfully" << endl;     
            id++;
        }
    }

    if (input == 4){
        input = 0;
        cout << endl << endl << "Enter SQLite3 code for evaluation: ";
        getline(cin, sql);
        exit = sqlite3_exec(DB, sql.c_str(), callback, (void*)data, &messaggeError); 
        cout << sql << endl;

        if (exit != SQLITE_OK) { 
            cerr << "Error running command" << endl; 
            sqlite3_free(messaggeError); 
        } 
        else
            cout << "Command run successfully" << endl; 
    }

    if (input == 5){
        cout << "Saving data..." << endl;
        ofstream file;
        file.open ("id.txt");
        file << id;
        file.close();
        cout << "Saving complete" << endl;
    }

    cout << "...Press ENTER to continue";
    cin.get();
    
    

    }
    sqlite3_close(DB); 
    return (0); 
} 