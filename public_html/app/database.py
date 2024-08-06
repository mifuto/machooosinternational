# database.py
import mysql.connector
from config import CONFIG
import time

class DbConnector:
    cnx = None
    connected = False

    def __init__(self):
        #print("DB in init fn")
        self.connect()

    def __enter__(self):
        #print("DB in enter fn")
        return self
    
    def __exit__(self, exc_type, exc_value, traceback):
        #print("DB in exit fn")
        self.disconnect()

    def disconnect(self):
        if self.connected:
            try:
                self.cnx.close()
                #print("database - disconnected")
            except:
                print("database - error disconnecting")
            self.connected = False

    def connect(self):
        conn_counter = 0
        while not self.cnx:  
            try:
                #print("checking for connection")
                self.cnx = mysql.connector.connect(
                    host=CONFIG.DB_HOST,  # Replace with your MySQL server host
                    user=CONFIG.DB_USER,  # Replace with your MySQL username
                    password=CONFIG.DB_PASSWD,  # Replace with your MySQL password
                    database=CONFIG.DB_NAME  # Replace with your MySQL database name
                )
                self.connected = True
            except Exception as e:
                if conn_counter > 5:
                    #print("database - No connection available in pool")
                    connected = False
                time.sleep(0.5)
        #if self.connected:
        #    print("database - connected")
        return self.connected

    def query(self,sql,fetchResults=True):
        cursor=None
        result=None
        try:
            #print(sql)
            cursor = self.cnx.cursor(dictionary=True)
            cursor.execute(sql)
            if fetchResults:
                result = cursor.fetchall()
            else:
                result = cursor.lastrowid
        except Exception as e:
            print("DB error",e)
            return None
        finally:
            if cursor != None:
                cursor.close() 
        return result

    def getSingleResult(self,sql,col,fetchResults=True):
        res=self.query(sql)
        ret=0
        if res != None:
            #print(res)
            ret=res[0][col]
        return ret

    def insertRecord(self,tbl,dataKeyVals):
        insId=0
        try:
            keys=""
            vals=""
            for key in dataKeyVals:
                if keys != "":
                    keys += ", "
                    vals += ", "
                keys += f"{key}"
                vals += f"'{dataKeyVals[key]}'"
            sql = f'INSERT INTO {tbl}( {keys} ) VALUES( {vals} )'
            insId=self.query(sql,False)
            self.cnx.commit()
        except Exception as e:
            print("DB error","qry:",sql,"error:",e)
            return False
        return insId

    def updateRecord(self,tbl,id,dataKeyVals):
        try:
            sql = f"UPDATE {tbl} SET "
            dset = ""
            for key in dataKeyVals:
                if dset != "":
                    dset += ", "
                dset += f"{key}='{dataKeyVals[key]}'"
            sql += dset + f" WHERE ID={id}"
            self.query(sql,False)
            self.cnx.commit()
        except Exception as e:
            print("DB error","qry:",sql,"error:",e)
            return False
        return True
    