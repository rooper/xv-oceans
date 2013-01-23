int graphs = 0; //number of graphs currently
//prototype IP is http://169.254.63.189
Graph graph0 = new Graph("http://localhost/xv/info.html",0,100); //address, data field, maximum value

//init
PFont f = createFont("Arial",16,true);

void setup()
{
  //set the height of the window to graphs * 200 pixels
  int g = 200*graphs; 
  int r = 400;  //400px = 1 row of graphs
  //if more than 4 in a column, create a new column
  if(g > 800) {     
    g = 800;           
    r = 800;        //TODO notice that we have an 8-graph hardcoded limit, and our graphs are hardcoded to size
  }
  //set size of window
  size(r,g);        
  smooth();
}

void draw()
{
  background(255);
  stroke(0);
  strokeWeight(2);
  graph0.update();    //make sure all graphs are updated!
}

class Graph {
  //count the number of graphs the user creates/co)nstructs
  //graphs++;
  float[] data_graph;
  Graph (String _address, int _data_field, int _maximum) {
    String address = _address;
    int data_field = _data_field;
    int maximum = _maximum;
    data_graph = new float[400];  //an array of values 400px long
    for (int i = 0; i < data_graph.length; i++) {
      //set all values in the array to 0...make a flat line to start.
      data_graph[i] = 0;      
    }
    //draw lines connecting all points for the graph...should all be at 0
    for (int i = 0; i < data_graph.length-1; i++) {
      line(i,data_graph[i],i+1,data_graph[i+1]);
    }
  }
  void update() {
    //get data from our website and parse it
    //data is in an array. check doc on loadStrings for more info
    String[] in_data = loadStrings(address); 
    println("in data[0] is "+in_data[0]);
    String[] data = split(in_data[0],',');
     //get our requested data element from the parsed page..notice the string to float conversion
    float datum = float(data[data_field]);       
    //normalize the data to [0,100]
    datum = norm(datum, 0, maximum)*100;
    //draw current graph
    for (int i = 0; i < data_graph.length-1; i++) {
      line(i,data_graph[i],i+1,data_graph[i+1]);
    }
    //update the array by sliding all points down a slot..in preparation for next data point
    for (int i = 0; i < data_graph.length-1; i++) {
      data_graph[i] = data_graph[i+1]; 
    }
    //add the newest data point to the end of our data array
    data_graph[data_graph.length-1] = datum;
  }
}
