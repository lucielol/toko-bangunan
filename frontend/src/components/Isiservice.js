import { Row, Col, Container } from "react-bootstrap";
import "../style/landingPage.css";

const Isiservice = () => {
    return (
        <div className="Isiservice">
            <div className="Isiservice1">
            <Container className="text-white text-left d-flex justify-content-center align-items-center ">
                <Row>
                    <Col>
                         <div>
                            <div className="titleIsiservice1"><p>Jasa Kuli</p></div>
                            <div className="titleIsiservice2"><p>Aseli jawa coy!</p></div>
                         </div>
                    </Col>
                </Row>
            </Container>
            </div>
            
            <div className="Isiservice2">
            <Container className="text-white text-left d-flex justify-content-center align-items-center ">
                <Row>
                    <Col>
                         <div>
                            <div className="titleIsiservice1"><p>Bangunan</p></div>
                            <div className="titleIsiservice2"><p>semen, cat, dll</p></div>
                         </div>
                    </Col>
                </Row>
            </Container>
            </div>
           
            <div className="Isiservice3">
            <Container className="text-white text-left d-flex justify-content-center align-items-center ">
                <Row>
                    <Col>
                         <div>
                            <div className="titleIsiservice1"><p>Material</p></div>
                            <div className="titleIsiservice2"><p>paku, palu, dll</p></div>
                         </div>
                    </Col>
                </Row>
            </Container>
            </div>
            
            <div className="Isiservice4">
            <Container className="text-white text-left d-flex justify-content-center align-items-center ">
                <Row>
                    <Col>
                         <div>
                            <div className="titleIsiservice1"><p>Extra JOSS!</p></div>
                            <div className="titleIsiservice2"><p>BUFF untuk kuli jawa</p></div>
                         </div>
                    </Col>
                </Row>
            </Container>
            </div>

        </div>
    )
}

export default Isiservice;