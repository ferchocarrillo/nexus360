
            <div class="carousel-item">
                <div class="logo_top">
                    <img src="\img\salesShow\logo_enercare.png" alt="">
                </div>
                <div class="line">
                    <h1 class="lob">SALES CONVERSION BILLING</h1>
                </div>
                <div class="card-deck" style="background-image: url(/img/salesShow/fondoConverse2.jpg);background-repeat: no-repeat; background-size: cover; overflow: hidden; height: 100vh;">
                    <div class="card">
                        <h5 class="card-title">
                            {{--  /*daily sales conversion billing*/  --}}
                            <span>D</span><span>A</span><span>I</span><span>L</span><span>Y</span><span>&nbsp;</span>
                        </h5>
                        <main class="grid">
                            <article>
                                <div class="center">
                                    <div class="card-1">
                                        <div class="header-gold">Ranking 1</div>
                                        <div class="content">
                                            <p>
                                                {{ $c_a_dBill1 }}
                                                <br>
                                                {{ $c_a_dBill1Count }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="card-2">
                                        <div class="header-bronze">Ranking 3</div>
                                        <div class="content">
                                            <p>
                                                {{ $c_a_dBill3 }}
                                                <br>
                                                {{ $c_a_dBill3Count }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="card-3">
                                        <div class="header-silver">Ranking 2</div>
                                        <div class="content">
                                            <p>
                                                {{ $c_a_dBill2 }}
                                                <br>
                                                {{ $c_a_dBill2Count }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <article class="listado_otros">
                                <div class="parent">
                                    <div class="div1">
                                        <label class="label_otros" for="">4</label><br>
                                        <label class="label_otros" for="">5</label><br>
                                        <label class="label_otros" for="">6</label><br>
                                        <label class="label_otros" for="">7</label><br>
                                        <label class="label_otros" for="">8</label>
                                    </div>
                                    <div class="div2">
                                        <input class="otros-izq-c" type="text" value="{{ $c_a_dBill4 }}"><br>
                                        <input class="otros-izq-c" type="text" value="{{ $c_a_dBill5 }}"><br>
                                        <input class="otros-izq-c" type="text" value="{{ $c_a_dBill6 }}"><br>
                                        <input class="otros-izq-c" type="text" value="{{ $c_a_dBill7 }}"><br>
                                        <input class="otros-izq-c" type="text" value="{{ $c_a_dBill8 }}">
                                    </div>
                                    <div class="div3">
                                        <input type="text" class="otros-der-c" value="{{ $c_a_dBill4Count }}%"><br>
                                        <input type="text" class="otros-der-c" value="{{ $c_a_dBill5Count }}%"><br>
                                        <input type="text" class="otros-der-c" value="{{ $c_a_dBill6Count }}%"><br>
                                        <input type="text" class="otros-der-c" value="{{ $c_a_dBill7Count }}%"><br>
                                        <input type="text" class="otros-der-c" value="{{ $c_a_dBill8Count }}%">
                                    </div>
                                </div>
                            </article>
                        </main>
                        <article class="listado_super">
                            <h5 class="card-title">
                                {{--  /*supervisor daily sales conversion billing*/  --}}
                                <span>S</span><span>U</span><span>P</span><span>E</span><span>R</span><span>V</span><span>I</span><span>S</span><span>O</span><span>R</span>
                                <span>&nbsp;</span><span>D</span><span>A</span><span>I</span><span>L</span><span>Y</span>
                            </h5>
                            <div class="parent">
                                <div class="div1a">
                                    <label class="label_otros" for="">1</label><br>
                                    <label class="label_otros" for="">2</label><br>
                                    <label class="label_otros" for="">3</label>
                                </div>
                                <div class="div2a">
                                    <input class="otros-izq-c2" type="text" value="{{ $c_s_dBill1 }}"><br>
                                    <input class="otros-izq-c2" type="text" value="{{ $c_s_dBill2 }}"><br>
                                    <input class="otros-izq-c2" type="text" value="{{ $c_s_dBill3 }}">
                                </div>
                                <div class="div3a">
                                    <input type="text" class="otros-der-c" value="{{ $c_s_dBill1Count }}%"><br>
                                    <input type="text" class="otros-der-c" value="{{ $c_s_dBill2Count }}%"><br>
                                    <input type="text" class="otros-der-c" value="{{ $c_s_dBill3Count }}%">
                                </div>
                            </div>
                        </article>
                    </div>
                    <div class="card">
                        <h5 class="card-title">
                            {{--  /*weekly sales  conversion billing*/  --}}
                            <span>W</span><span>E</span><span>E</span><span>K</span><span>L</span><span>Y</span><span>&nbsp;</span>
                            <span>S</span><span>A</span><span>L</span><span>E</span><span>S</span>
                        </h5>
                        <main class="grid">
                            <article>
                                <div class="center">
                                    <div class="card-1">
                                        <div class="header-gold">Ranking 1</div>
                                        <div class="content">
                                            <p>
                                                {{ $c_aBill1 }}
                                                <br>
                                                {{ $c_aBill1Count }}%
                                            </p>
                                        </div>
                                    </div>
                                    <div class="card-2">
                                        <div class="header-bronze">Ranking 3</div>
                                        <div class="content">
                                            <p>
                                                {{ $c_aBill3 }}
                                                <br>
                                                {{ $c_aBill3Count }}%
                                            </p>
                                        </div>
                                    </div>
                                    <div class="card-3">
                                        <div class="header-silver">Ranking 2</div>
                                        <div class="content">
                                            <p>
                                                {{ $c_aBill2 }}
                                                <br>
                                                {{ $c_aBill2Count }}%
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <article class="listado_otros">
                                <div class="parent">
                                    <div class="div1">
                                        <label class="label_otros" for="">4</label><br>
                                        <label class="label_otros" for="">5</label><br>
                                        <label class="label_otros" for="">6</label><br>
                                        <label class="label_otros" for="">7</label><br>
                                        <label class="label_otros" for="">8</label>
                                    </div>
                                    <div class="div2">
                                        <input class="otros-izq-c" type="text" value="{{ $c_aBill4 }}"><br>
                                        <input class="otros-izq-c" type="text" value="{{ $c_aBill5 }}"><br>
                                        <input class="otros-izq-c" type="text" value="{{ $c_aBill6 }}"><br>
                                        <input class="otros-izq-c" type="text" value="{{ $c_aBill7 }}"><br>
                                        <input class="otros-izq-c" type="text" value="{{ $c_aBill8 }}">
                                    </div>
                                    <div class="div3">
                                        <input type="text" class="otros-der-c" value="{{ $c_aBill4Count }}%"><br>
                                        <input type="text" class="otros-der-c" value="{{ $c_aBill5Count }}%"><br>
                                        <input type="text" class="otros-der-c" value="{{ $c_aBill6Count }}%"><br>
                                        <input type="text" class="otros-der-c" value="{{ $c_aBill7Count }}%"><br>
                                        <input type="text" class="otros-der-c" value="{{ $c_aBill8Count }}%">
                                    </div>
                                </div>
                            </article>
                        </main>
                        <article class="listado_super">
                            <h5 class="card-title">
                                {{--  /*weekly supervisor conversion billing*/  --}}
                                <span>S</span><span>U</span><span>P</span><span>E</span><span>R</span><span>V</span><span>I</span><span>S</span><span>O</span><span>R</span>
                                <span>&nbsp;</span><span>W</span><span>E</span><span>E</span><span>K</span><span>L</span><span>Y</span>
                            </h5>
                            <div class="parent">
                                <div class="div1a">
                                    <label class="label_otros" for="">1</label><br>
                                    <label class="label_otros" for="">2</label><br>
                                    <label class="label_otros" for="">3</label>
                                </div>
                                <div class="div2a">
                                    <input class="otros-izq-c2" type="text" value="{{ $c_sBill1 }}"><br>
                                    <input class="otros-izq-c2" type="text" value="{{ $c_sBill2 }}"><br>
                                    <input class="otros-izq-c2" type="text" value="{{ $c_sBill3 }}">
                                </div>
                                <div class="div3a">
                                    <input type="text" class="otros-der-c" value="{{ $c_sBill1Count }}%"><br>
                                    <input type="text" class="otros-der-c" value="{{ $c_sBill2Count }}%"><br>
                                    <input type="text" class="otros-der-c" value="{{ $c_sBill3Count }}%">
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
