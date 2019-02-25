## java 链表了解学习

- java 链表学习，主要的类 java.Util.LinkedList

->.使用链表之前首先引入 `import java.Util.LinkedList`

->.查看`LinkedList`类我们就可以看到，它是这样定义的：

```java
public class LinkedList<E>
    extends AbstractSequentialList<E>
    implements List<E>, Deque<E>, Cloneable, java.io.Serializable {}
```
先继承 `AbstractSequentialList<E>`这个类，然后实现 `implements List<E>, Deque<E>, Cloneable, java.io.Serializable`后面这些接口

在使用的时候，我们也是使用关键字 `new` 来实现

```java

public static void main(String [] args) {
    
    LinkedList<String> link = new LinkedList<String>();
}
```

可以看到，它和我们普通实例化类的时候不同，在类名的后面我们需要指定我们正在使用的数据类型是什么；就是在使用的时候，我们就会规定这个链表存储的是什么样的数据；

-> 实例化完成之后，我们需要在链表中添加数据，我们可以看到一个 `add()`的方法，在java中我们知道有一个词叫做 **重载**，在这里`add()`方法
就使用了它

```java
// ==》 LinkedList
 public boolean add(E e) {
        linkLast(e);
        return true;
    }
    
  public void add(int index, E element) {
         checkPositionIndex(index);
 
         if (index == size)
             linkLast(element);
         else
             linkBefore(element, node(index));
     }
     
  public void add(E e) {
              checkForComodification();
              lastReturned = null;
              if (next == null)
                  linkLast(e);
              else
                  linkBefore(e, next);
              nextIndex++;
              expectedModCount++;
          }     
     
// ==》AbstractSequentialList<E>

public void add(int index, E element) {
        try {
            listIterator(index).add(element);
        } catch (NoSuchElementException exc) {
            throw new IndexOutOfBoundsException("Index: "+index);
        }
    }      
```

使用是非常简单的，在前面我们已经实例化了，所以在后面我们直接调用就可以了；

````java
for (int i=0; i<10; i++) {
    link.add("链表添加元素:"+i);
}
````

我们可以看到，调用它的时候，我们可以传一个参数，或者我们传两个参数，传两个参数时，第一个参数必须是 `int`类型

-> 得到链表的第一个元素，调用方法 `getFirst()`

```java
// ==》LinkedList
public E getFirst() {
        final Node<E> f = first;
        if (f == null)
            throw new NoSuchElementException();
        return f.item;
    }
```


```java
String first = link.getFirst();
System.out.print(first);
```


-> 得到链表的最后一个元素,调用方法 `getLast()`

```java
// ==》LinkedList
public E getLast() {
        final Node<E> l = last;
        if (l == null)
            throw new NoSuchElementException();
        return l.item;
    }
```

```java
String last = link.getLast();
System.out.print(last);
```

-> 在链表的开头首位添加元素，调用方法 `addFirst()`

```java
// ==》 LinkedList
public void addFirst(E e) {
        linkFirst(e);
    }
```

调用 `link.addFirst("首位")`


-> 在链表的末尾围位添加元素,调用方法 `addLast()`

```java
// ==》 LinkedList
public void addLast(E e) {
        linkLast(e);
    }
```

调用 `link.addLast("尾位")`


-> 删掉链表元素的值，调用方法 `link.subList("起始索引的位置","结束索引的位置").clear()`，得到的就是最后截取剩下来的值

```java
// ==》 在接口 ：List<> 中定义

List<E> subList(int fromIndex, int toIndex);

//调用

link.subList(2,4).clear();

链表可以直接打印
System.out.println(link);
```






