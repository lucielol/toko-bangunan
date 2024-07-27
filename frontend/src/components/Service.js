import { Row, Col, Container } from "react-bootstrap";
import "../style/landingPage.css";

const Service = () => {
    return(
        <div className="service">
            <Container className="text-white text-center d-flex justify-content-center align-items-center">
                <Row> 
                    <Col>
                        <div className="title">Our Service</div>
                    </Col>
                </Row>
            </Container>
        </div>
    )
}

export default Service;