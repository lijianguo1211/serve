package thread;

public class Caller implements Runnable {
       String msg;
       Callme target;
       Thread t;

       public void Caller (Callme tag, String s) {
            target = tag;
            msg = s;
            t = new Thread(this);
            t.start();
       }

       public void run() {
            target.call(msg);
       }
}
